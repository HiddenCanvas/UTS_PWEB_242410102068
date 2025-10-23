<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'Home') - Elixir Of Life</title>

    {{-- Vite untuk Tailwind CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'Home') - Elixir Of Life</title>

    {{-- Vite untuk Tailwind CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Base URL untuk assets --}}
    <base href="{{ asset('/') }}">
    
    {{-- Custom CSS inline untuk dark theme --}}
    <style>
        body {
            background-color: #0a0a0a;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        main {
            flex: 1;
        }
        
        .theme-dark {
            background: #0a0a0a;
        }
        
        /* .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        } */
    </style>

    {{-- Placeholder untuk styles khusus halaman --}}
    @stack('styles')
</head>
<body class="theme-dark">
    
    {{-- Navbar Component --}}
    <x-navbar />

    {{-- Main Content Area --}}
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    {{-- Footer Include --}}
    @include('components.footer')

    {{-- Scripts khusus per halaman --}}
    @stack('scripts')
</body>
</html>
