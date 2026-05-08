@php
    $pageHeading = 'Message from '.$message->name;
@endphp

@extends('admin.layouts.app')

@section('title', 'Message Details')

@section('content')
    <section class="admin-grid-two">
        <div class="admin-card">
            <div class="admin-card-head">
                <h2>{{ $message->subject }}</h2>
                <p>{{ $message->created_at->format('M j, Y g:i A') }}</p>
            </div>

            <div class="admin-detail-grid">
                <div>
                    <span>Name</span>
                    <strong>{{ $message->name }}</strong>
                </div>
                <div>
                    <span>Phone</span>
                    <strong>{{ $message->phone }}</strong>
                </div>
                <div>
                    <span>Email</span>
                    <strong>{{ $message->email }}</strong>
                </div>
                <div>
                    <span>Status</span>
                    <strong>{{ $message->is_read ? 'Read' : 'Unread' }}</strong>
                </div>
            </div>

            <div class="mt-4">
                <h3 class="admin-section-title">Message</h3>
                <div class="admin-message-body">{{ $message->message }}</div>
            </div>
        </div>

        <div class="admin-card admin-form-card">
            <div class="admin-card-head">
                <h2>Actions</h2>
                <p>Use the details below to follow up directly.</p>
            </div>

            <div class="admin-list-stack">
                <a href="mailto:{{ $message->email }}" class="admin-action-tile">Reply by Email</a>
                <a href="tel:{{ preg_replace('/\s+/', '', $message->phone) }}" class="admin-action-tile">Call Sender</a>
                <a href="{{ route('admin.messages.index') }}" class="admin-action-tile">Back to Inbox</a>
            </div>

            @unless ($message->is_read)
                <form action="{{ route('admin.messages.read', $message) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="admin-btn">Mark As Read</button>
                </form>
            @endunless
        </div>
    </section>
@endsection
