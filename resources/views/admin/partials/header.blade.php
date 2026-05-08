<header class="admin-header">
    <div>
        <p class="admin-kicker">Max Kebab Backend</p>
        <h1 class="admin-page-title">{{ $pageHeading ?? trim($__env->yieldContent('title')) ?: 'Dashboard' }}</h1>
        <div class="admin-header-meta">
            <a href="{{ route('home') }}" class="admin-meta-chip" target="_blank" rel="noopener">
                <i class="icofont-external-link"></i>
                View Storefront
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="admin-meta-chip">
                <i class="icofont-bag"></i>
                Pending Orders
                <strong>{{ $adminNavStats['pending_orders'] ?? 0 }}</strong>
            </a>
            <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" class="admin-meta-chip">
                <i class="icofont-envelope-open"></i>
                Unread Messages
                <strong>{{ $adminNavStats['unread_messages'] ?? 0 }}</strong>
            </a>
        </div>
    </div>

    <div class="admin-header-actions">
        <div class="admin-user-chip">
            <span>{{ auth()->user()?->name }}</span>
            <small>{{ auth()->user()?->email }}</small>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="admin-logout-btn">Log Out</button>
        </form>
    </div>
</header>
