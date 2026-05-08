@php
    $editing = isset($category) && $category->exists;
@endphp

<form action="{{ $editing ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST" class="admin-card admin-form-card">
    @csrf
    @if ($editing)
        @method('PUT')
    @endif

    <div class="admin-card-head">
        <h2>{{ $editing ? 'Edit Category' : 'Create Category' }}</h2>
        <p>Keep the menu sections tidy and in the right order.</p>
    </div>

    <div class="admin-form-grid two-col">
        <div>
            <label class="admin-label">Name</label>
            <input type="text" name="name" class="admin-input" value="{{ old('name', $category->name ?? '') }}" required>
        </div>
        <div>
            <label class="admin-label">Slug</label>
            <input type="text" name="slug" class="admin-input" value="{{ old('slug', $category->slug ?? '') }}" placeholder="auto-generated if blank">
        </div>
        <div>
            <label class="admin-label">Icon Path</label>
            <input type="text" name="icon" class="admin-input" value="{{ old('icon', $category->icon ?? '') }}" placeholder="assets/images/menu-1.png" required>
        </div>
        <div>
            <label class="admin-label">Sort Order</label>
            <input type="number" name="sort_order" class="admin-input" min="0" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
        </div>
    </div>

    <div class="mt-3">
        <label class="admin-label">Description</label>
        <textarea name="description" class="admin-textarea" rows="4" placeholder="Optional description for the admin team">{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <label class="admin-check mt-3">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $editing ? $category->is_active : true))>
        <span>Show this category on the storefront</span>
    </label>

    <div class="admin-form-actions">
        <button type="submit" class="admin-btn">{{ $editing ? 'Save Changes' : 'Create Category' }}</button>
        @if ($editing)
            <a href="{{ route('admin.categories.index') }}" class="admin-btn admin-btn-muted">Back</a>
        @endif
    </div>
</form>
