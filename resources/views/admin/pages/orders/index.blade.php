@php
    $pageHeading = 'Orders';
@endphp

@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
    <section class="admin-card">
        <div class="admin-card-head">
            <h2>Order Queue</h2>
            <p>Track dine-in, takeaway, and delivery orders from one place.</p>
        </div>

        <form action="{{ route('admin.orders.index') }}" method="GET" class="admin-filter-bar">
            <input type="text" name="search" class="admin-input" placeholder="Search by reference, name, or phone" value="{{ $filters['search'] ?? '' }}">
            <select name="status" class="admin-input">
                <option value="">All statuses</option>
                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}" @selected(($filters['status'] ?? '') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <button type="submit" class="admin-btn">Filter</button>
        </form>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Customer</th>
                        <th>Type</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->reference }}</td>
                            <td>
                                <strong>{{ $order->customer_name }}</strong>
                                <span>{{ $order->phone }}</span>
                            </td>
                            <td>{{ strtoupper(str_replace('_', ' ', $order->order_type)) }}</td>
                            <td>{{ $order->items_count }}</td>
                            <td>£{{ number_format((float) $order->total, 2) }}</td>
                            <td><span class="status-chip status-{{ $order->status }}">{{ str_replace('_', ' ', $order->status) }}</span></td>
                            <td><a href="{{ route('admin.orders.show', $order) }}" class="admin-link">Open</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="admin-empty-copy">No orders found for this filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
