<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Admin') | Max Kebab</title>
    <link rel="icon" href="{{ asset('assets/images/tab.png') }}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/max-kebab-admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">
    <div class="admin-shell">
        @include('admin.partials.sidebar')

        <div class="admin-content-wrap">
            @include('admin.partials.header')

            <main class="admin-main">
                @include('shared.flash-messages', ['context' => 'admin'])

                @yield('content')
            </main>
        </div>
    </div>

    @include('admin.partials.confirm-dialog')

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/max-kebab-admin.js') }}"></script>
    @stack('scripts')
</body>
</html>
