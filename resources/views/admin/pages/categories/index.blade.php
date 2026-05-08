@php
    $pageHeading = 'Categories';
@endphp

@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
    <section class="admin-grid-two admin-grid-wide-left">
        @include('admin.partials.category-form')

        <div class="admin-card">
            <div class="admin-card-head">
                <h2>Current Categories</h2>
                <p>These drive the menu tabs and shop filters on the site.</p>
            </div>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Items</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>
                                    <strong>{{ $category->name }}</strong>
                                    @if ($category->icon)
                                        <span>{{ $category->icon }}</span>
                                    @endif
                                </td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->products_count }}</td>
                                <td><span class="status-chip {{ $category->is_active ? 'status-completed' : 'status-cancelled' }}">{{ $category->is_active ? 'Live' : 'Hidden' }}</span></td>
                                <td class="admin-table-actions">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="admin-link">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" data-confirm="Delete this category?" data-confirm-detail="You can only remove categories that do not still contain live products.">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-text-btn danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="admin-empty-copy">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
