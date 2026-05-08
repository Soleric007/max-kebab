@php
    $pageHeading = 'Messages';
@endphp

@extends('admin.layouts.app')

@section('title', 'Messages')

@section('content')
    <section class="admin-card">
        <div class="admin-card-head">
            <h2>Contact Inbox</h2>
            <p>Enquiries from the contact form are saved here for follow-up.</p>
        </div>

        <form action="{{ route('admin.messages.index') }}" method="GET" class="admin-filter-bar">
            <input type="text" name="search" class="admin-input" placeholder="Search by name, email, or subject" value="{{ $filters['search'] ?? '' }}">
            <select name="status" class="admin-input">
                <option value="">All messages</option>
                <option value="unread" @selected(($filters['status'] ?? '') === 'unread')>Unread</option>
                <option value="read" @selected(($filters['status'] ?? '') === 'read')>Read</option>
            </select>
            <button type="submit" class="admin-btn">Filter</button>
        </form>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $message)
                        <tr>
                            <td>
                                <strong>{{ $message->name }}</strong>
                                <span>{{ $message->email }}</span>
                            </td>
                            <td>{{ $message->subject }}</td>
                            <td><span class="status-chip {{ $message->is_read ? 'status-completed' : 'status-pending' }}">{{ $message->is_read ? 'Read' : 'Unread' }}</span></td>
                            <td>{{ $message->created_at->format('M j, Y g:i A') }}</td>
                            <td><a href="{{ route('admin.messages.show', $message) }}" class="admin-link">Open</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="admin-empty-copy">No messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
