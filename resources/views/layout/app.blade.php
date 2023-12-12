<!DOCTYPE html>
<html lang="lang="{{ str_replace('_', '-', app()->getLocale()) }}"">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fontawesome css --}}
    <link rel="stylesheet" href="{{ asset('fontawesome-6.5.1/css/all.min.css')}}">
    
    {{-- custom css --}}
    @stack('css')
</head>
<body>
    <header>
        <x-navbar></x-navbar>
    </header>
    <main>
        @yield("content")
    </main>
    <footer></footer>

    <script src="{{ asset('assets/js/main.js')}}"></script>
    @stack('js')
</body>
</html>