<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('logo/logo.png') }}" type="image/png"/>

    <title>{{ config('app.name', 'CBRS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- jQuery and Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Scripts and Styles -->
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col" x-data="navigation">
    <!-- Header -->
    @include('components.Header')

    <!-- Page Content -->
    <main class="flex-grow mt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.Footer')

    <!-- Initialize Alpine.js -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('navigation', () => ({
                mobileMenuOpen: false
            }))
        })
    </script>
</body>
</html> 