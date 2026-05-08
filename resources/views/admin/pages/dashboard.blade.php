@php
    $pageHeading = 'Dashboard';
@endphp

@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="admin-dashboard-hero">
        <div>
            <p class="admin-dashboard-kicker">Daily Overview</p>
            <h2>Keep Max Kebab moving smoothly across dine-in, takeaway, and delivery.</h2>
            <p class="admin-dashboard-copy">Use this view to spot order pressure, menu gaps, and unread customer messages before they slow down service.</p>
        </div>
        <div class="admin-kpi-inline">
            <div>
                <span>Today&apos;s Orders</span>
                <strong>{{ $metrics['today_orders'] }}</strong>
            </div>
            <div>
                <span>Active Products</span>
                <strong>{{ $metrics['active_products'] }}</strong>
            </div>
            <div>
                <span>Average Completed Order</span>
                <strong>£{{ number_format($metrics['average_order_value'], 2) }}</strong>
            </div>
        </div>
    </section>

    <section class="admin-metrics-grid">
        <div class="admin-metric-card">
            <p>Categories</p>
            <h2>{{ $metrics['categories'] }}</h2>
        </div>
        <div class="admin-metric-card">
            <p>Products</p>
            <h2>{{ $metrics['products'] }}</h2>
        </div>
        <div class="admin-metric-card">
            <p>Pending Orders</p>
            <h2>{{ $metrics['pending_orders'] }}</h2>
        </div>
        <div class="admin-metric-card">
            <p>Delivery Queue</p>
            <h2>{{ $metrics['delivery_orders'] }}</h2>
        </div>
        <div class="admin-metric-card">
            <p>Revenue</p>
            <h2>£{{ number_format($metrics['revenue'], 2) }}</h2>
        </div>
        <div class="admin-metric-card">
            <p>Unread Messages</p>
            <h2>{{ $metrics['unread_messages'] }}</h2>
        </div>
    </section>

    <section class="admin-grid-two mt-4">
        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Order Pipeline</h2>
                <p>A quick look at where orders are sitting right now.</p>
            </div>
            <div class="admin-status-grid">
                @foreach ($statusBreakdown as $item)
                    <a href="{{ route('admin.orders.index', ['status' => $item['status']]) }}" class="admin-status-card">
                        <span class="status-chip status-{{ $item['status'] }}">{{ $item['label'] }}</span>
                        <strong>{{ $item['count'] }}</strong>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Service Mix</h2>
                <p>See which fulfilment channels are carrying the most orders.</p>
            </div>
            <div class="admin-list-stack">
                @foreach ($orderMix as $mix)
                    <div class="admin-list-row">
                        <div>
                            <strong>{{ $mix['label'] }}</strong>
                            <span>Orders placed through this channel</span>
                        </div>
                        <div class="text-end">
                            <strong>{{ $mix['count'] }}</strong>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="admin-grid-two mt-4">
        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Quick Actions</h2>
                <p>Keep the menu and orders moving.</p>
            </div>
            <div class="admin-action-grid">
                <a href="{{ route('admin.products.create') }}" class="admin-action-tile">Add New Product</a>
                <a href="{{ route('admin.categories.index') }}" class="admin-action-tile">Manage Categories</a>
                <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="admin-action-tile">Review Pending Orders</a>
                <a href="{{ route('admin.orders.index', ['status' => 'out_for_delivery']) }}" class="admin-action-tile">Check Delivery Orders</a>
                <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" class="admin-action-tile">Open Unread Messages</a>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Top Menu Items</h2>
                <p>Items currently carrying the strongest social proof.</p>
            </div>
            <div class="admin-list-stack">
                @forelse ($popularProducts as $product)
                    <div class="admin-list-row">
                        <div>
                            <strong>{{ $product->name }}</strong>
                            <span>{{ $product->category?->name }}</span>
                        </div>
                        <div class="text-end">
                            <strong>£{{ number_format((float) $product->price, 2) }}</strong>
                            <span>{{ $product->review_count }} reviews</span>
                        </div>
                    </div>
                @empty
                    <p class="admin-empty-copy">No products have been seeded yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="admin-grid-two mt-4">
        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Latest Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="admin-link">View all</a>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latestOrders as $order)
                            <tr>
                                <td>{{ $order->reference }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td><span class="status-chip status-{{ $order->status }}">{{ str_replace('_', ' ', $order->status) }}</span></td>
                                <td>£{{ number_format((float) $order->total, 2) }}</td>
                                <td><a href="{{ route('admin.orders.show', $order) }}" class="admin-link">Open</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="admin-empty-copy">No orders yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Recent Messages</h2>
                <a href="{{ route('admin.messages.index') }}" class="admin-link">Inbox</a>
            </div>
            <div class="admin-list-stack">
                @forelse ($recentMessages as $message)
                    <a href="{{ route('admin.messages.show', $message) }}" class="admin-message-snippet">
                        <strong>{{ $message->subject }}</strong>
                        <span>{{ $message->name }} • {{ $message->created_at->format('M j, Y g:i A') }}</span>
                        <p>{{ \Illuminate\Support\Str::limit($message->message, 110) }}</p>
                    </a>
                @empty
                    <p class="admin-empty-copy">No messages have come in yet.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
