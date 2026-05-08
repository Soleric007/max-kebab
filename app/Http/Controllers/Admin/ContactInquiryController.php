<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactInquiryController extends Controller
{
    public function index(Request $request): View
    {
        $messages = ContactInquiry::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('is_read', $request->string('status')->toString() === 'read'))
            ->latest()
            ->get();

        return view('admin.pages.messages.index', [
            'messages' => $messages,
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    public function show(ContactInquiry $message): View
    {
        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.pages.messages.show', compact('message'));
    }

    public function markRead(ContactInquiry $message): RedirectResponse
    {
        $message->update(['is_read' => true]);

        return back()->with('success', 'Message marked as read.');
    }
}
