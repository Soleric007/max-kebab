<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login | Max Kebab</title>
    <link rel="icon" href="{{ asset('assets/images/tab.png') }}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/max-kebab-admin.css') }}">
</head>
<body class="admin-auth-body">
    @include('shared.flash-messages', ['context' => 'admin'])

    <main class="admin-auth-shell">
        <section class="admin-auth-panel">
            <div class="admin-auth-copy">
                <p class="admin-kicker">Max Kebab Backend</p>
                <h1>Sign in to manage the restaurant</h1>
                <p>Orders, menu items, categories, and customer enquiries now live in one proper Laravel admin area.</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="admin-auth-form">
                @csrf

                <div>
                    <label class="admin-label">Email Address</label>
                    <input type="email" name="email" class="admin-input" value="{{ old('email') }}" required autofocus>
                    @error('email')<div class="admin-error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="admin-label">Password</label>
                    <input type="password" name="password" class="admin-input" required>
                    @error('password')<div class="admin-error">{{ $message }}</div>@enderror
                </div>

                <label class="admin-check">
                    <input type="checkbox" name="remember" value="1">
                    <span>Keep me signed in on this device</span>
                </label>

                <button type="submit" class="admin-btn w-100">Sign In</button>
            </form>

            <a href="{{ route('home') }}" class="admin-auth-link">Back to storefront</a>
        </section>
    </main>

    <script src="{{ asset('assets/js/max-kebab-admin.js') }}"></script>
</body>
</html>
