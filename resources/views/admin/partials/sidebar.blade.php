<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="admin-brand-link">
            Max <span>Kebab</span>
            <small>Admin</small>
        </a>
    </div>

    <nav class="admin-nav">
        <div class="admin-nav-group">
            <p class="admin-nav-label">Overview</p>
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="icofont-dashboard-web"></i>
                <span class="admin-nav-copy">Dashboard</span>
            </a>
        </div>

        <div class="admin-nav-group">
            <p class="admin-nav-label">Catalogue</p>
            <a href="{{ route('admin.categories.index') }}" class="admin-nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="icofont-food-basket"></i>
                <span class="admin-nav-copy">Categories</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="admin-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="icofont-burger"></i>
                <span class="admin-nav-copy">Products</span>
            </a>
        </div>

        <div class="admin-nav-group">
            <p class="admin-nav-label">Operations</p>
            <a href="{{ route('admin.orders.index') }}" class="admin-nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="icofont-bag"></i>
                <span class="admin-nav-copy">Orders</span>
                @if (($adminNavStats['pending_orders'] ?? 0) > 0)
                    <span class="admin-nav-pill">{{ $adminNavStats['pending_orders'] }}</span>
                @endif
            </a>
            <a href="{{ route('admin.messages.index') }}" class="admin-nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                <i class="icofont-envelope-open"></i>
                <span class="admin-nav-copy">Messages</span>
                @if (($adminNavStats['unread_messages'] ?? 0) > 0)
                    <span class="admin-nav-pill">{{ $adminNavStats['unread_messages'] }}</span>
                @endif
            </a>
        </div>
    </nav>

    <div class="admin-sidebar-footer">
        <a href="{{ route('home') }}" class="admin-sidebar-store-link" target="_blank" rel="noopener">View Storefront</a>
    </div>
</aside>
