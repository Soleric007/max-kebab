<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactInquiry;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $orders = Order::query();
        $completedOrderCount = (clone $orders)->where('status', 'completed')->count();
        $todayOrders = (clone $orders)->whereDate('created_at', today())->count();
        $deliveryOrders = (clone $orders)->whereIn('status', ['pending', 'preparing', 'out_for_delivery'])->where('order_type', 'delivery')->count();
        $orderMix = collect(['dine_in', 'takeaway', 'delivery'])
            ->mapWithKeys(fn (string $type) => [$type => (clone $orders)->where('order_type', $type)->count()]);
        $statusBreakdown = collect([
            'pending' => 'Pending',
            'preparing' => 'Preparing',
            'ready_for_collection' => 'Ready For Collection',
            'out_for_delivery' => 'Out For Delivery',
            'completed' => 'Completed',
        ])->map(function (string $label, string $status) use ($orders): array {
            return [
                'label' => $label,
                'count' => (clone $orders)->where('status', $status)->count(),
                'status' => $status,
            ];
        })->values();

        return view('admin.pages.dashboard', [
            'metrics' => [
                'categories' => Category::count(),
                'products' => Product::count(),
                'active_products' => Product::where('is_active', true)->count(),
                'pending_orders' => Order::where('status', 'pending')->count(),
                'today_orders' => $todayOrders,
                'delivery_orders' => $deliveryOrders,
                'revenue' => (float) Order::where('status', '!=', 'cancelled')->sum('total'),
                'average_order_value' => $completedOrderCount > 0
                    ? (float) Order::where('status', 'completed')->avg('total')
                    : 0,
                'unread_messages' => ContactInquiry::where('is_read', false)->count(),
            ],
            'latestOrders' => Order::withCount('items')->latest()->take(8)->get(),
            'popularProducts' => Product::with('category')->orderByDesc('featured')->orderByDesc('review_count')->take(6)->get(),
            'recentMessages' => ContactInquiry::latest()->take(5)->get(),
            'statusBreakdown' => $statusBreakdown,
            'orderMix' => $this->formatOrderMix($orderMix),
        ]);
    }

    private function formatOrderMix(Collection $orderMix): array
    {
        return [
            ['label' => 'Dine In', 'count' => $orderMix->get('dine_in', 0)],
            ['label' => 'Takeaway', 'count' => $orderMix->get('takeaway', 0)],
            ['label' => 'Delivery', 'count' => $orderMix->get('delivery', 0)],
        ];
    }
}
