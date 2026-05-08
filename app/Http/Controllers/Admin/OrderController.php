<?php

namespace App\Http\Controllers\Admin;

use App\Mail\OrderStatusUpdatedMail;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::query()
            ->withCount('items')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->where(function ($inner) use ($search) {
                    $inner->where('reference', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->latest()
            ->get();

        return view('admin.pages.orders.index', [
            'orders' => $orders,
            'filters' => $request->only(['search', 'status']),
            'statuses' => $this->statuses(),
        ]);
    }

    public function show(Order $order): View
    {
        return view('admin.pages.orders.show', [
            'order' => $order->load('items'),
            'statuses' => $this->statuses(),
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,preparing,ready_for_collection,out_for_delivery,completed,cancelled'],
            'admin_notes' => ['nullable', 'string', 'max:3000'],
        ]);

        $previousStatus = $order->status;
        $order->update($validated);

        $redirect = redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully.');

        if ($previousStatus !== $order->status && filled($order->email)) {
            try {
                Mail::to($order->email)->send(new OrderStatusUpdatedMail($order->fresh('items'), $previousStatus));
            } catch (Throwable $exception) {
                report($exception);
                $redirect->with('warning', 'Order updated, but the customer email notification could not be sent with the current mail setup.');
            }
        }

        return $redirect;
    }

    private function statuses(): array
    {
        return [
            'pending' => 'Pending',
            'preparing' => 'Preparing',
            'ready_for_collection' => 'Ready For Collection',
            'out_for_delivery' => 'Out For Delivery',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];
    }
}
