@php
    $pageHeading = 'Order '.$order->reference;
@endphp

@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')
    <section class="admin-grid-two">
        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Order Details</h2>
                <p>Placed {{ $order->created_at->format('M j, Y g:i A') }}</p>
            </div>

            <div class="admin-detail-grid">
                <div>
                    <span>Customer</span>
                    <strong>{{ $order->customer_name }}</strong>
                </div>
                <div>
                    <span>Phone</span>
                    <strong>{{ $order->phone }}</strong>
                </div>
                <div>
                    <span>Email</span>
                    <strong>{{ $order->email ?: 'Not provided' }}</strong>
                </div>
                <div>
                    <span>Order Type</span>
                    <strong>{{ strtoupper(str_replace('_', ' ', $order->order_type)) }}</strong>
                </div>
                <div>
                    <span>Preferred Time</span>
                    <strong>{{ $order->collection_time ?: 'Not specified' }}</strong>
                </div>
                <div>
                    <span>Total</span>
                    <strong>£{{ number_format((float) $order->total, 2) }}</strong>
                </div>
                @if ($order->order_type === 'delivery')
                    <div>
                        <span>Delivery Postcode</span>
                        <strong>{{ $order->delivery_postcode ?: 'Not provided' }}</strong>
                    </div>
                    <div>
                        <span>Delivery Address</span>
                        <strong>{{ $order->delivery_address ?: 'Not provided' }}</strong>
                    </div>
                @endif
            </div>

            <div class="mt-4">
                <h3 class="admin-section-title">Order Notes</h3>
                <p class="admin-note-panel">{{ $order->notes ?: 'No customer notes were added.' }}</p>
            </div>

            <div class="mt-4">
                <h3 class="admin-section-title">Items</h3>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Option</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->selected_option ?: 'Standard' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>£{{ number_format((float) $item->product_price, 2) }}</td>
                                    <td>£{{ number_format((float) $item->line_total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="admin-card admin-form-card">
            <div class="admin-card-head">
                <h2>Update Status</h2>
                <p>Keep the order flow tidy for staff and customers. Customers with an email address receive automatic status updates.</p>
            </div>

            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PATCH')

                <div>
                    <label class="admin-label">Status</label>
                    <select name="status" class="admin-input">
                        @foreach ($statuses as $value => $label)
                            <option value="{{ $value }}" @selected($order->status === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3">
                    <label class="admin-label">Admin Notes</label>
                    <textarea name="admin_notes" class="admin-textarea" rows="8" placeholder="Internal notes for the team">{{ old('admin_notes', $order->admin_notes) }}</textarea>
                </div>

                <div class="admin-form-actions">
                    <button type="submit" class="admin-btn">Save Update</button>
                    <a href="{{ route('admin.orders.index') }}" class="admin-btn admin-btn-muted">Back</a>
                </div>
            </form>
        </div>
    </section>
@endsection
