@php
    $pageHeading = 'Products';
@endphp

@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
    <section class="admin-card">
        <div class="admin-card-head">
            <div>
                <h2>Menu Products</h2>
                <p>Everything shown on the shop, product pages, wishlist, and checkout lives here now.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="admin-btn">Add Product</a>
        </div>

        <form action="{{ route('admin.products.index') }}" method="GET" class="admin-filter-bar">
            <input type="text" name="search" class="admin-input" placeholder="Search by name, SKU, or slug" value="{{ $filters['search'] ?? '' }}">
            <select name="category" class="admin-input">
                <option value="">All categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) ($filters['category'] ?? '') === (string) $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            <select name="status" class="admin-input">
                <option value="">Any status</option>
                <option value="active" @selected(($filters['status'] ?? '') === 'active')>Live</option>
                <option value="inactive" @selected(($filters['status'] ?? '') === 'inactive')>Hidden</option>
            </select>
            <button type="submit" class="admin-btn">Filter</button>
        </form>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                <strong>{{ $product->name }}</strong>
                                <span>{{ $product->sku }}</span>
                            </td>
                            <td>{{ $product->category?->name }}</td>
                            <td>
                                <strong>£{{ number_format((float) $product->price, 2) }}</strong>
                                @if ($product->compare_price)
                                    <span>£{{ number_format((float) $product->compare_price, 2) }}</span>
                                @endif
                            </td>
                            <td><span class="status-chip {{ $product->is_active ? 'status-completed' : 'status-cancelled' }}">{{ $product->is_active ? 'Live' : 'Hidden' }}</span></td>
                            <td>{{ $product->featured ? 'Yes' : 'No' }}</td>
                            <td class="admin-table-actions">
                                <a href="{{ route('admin.products.edit', $product) }}" class="admin-link">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" data-confirm="Delete this product?" data-confirm-detail="This removes it from the live menu and future basket flows.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-text-btn danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="admin-empty-copy">No products found for this filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
