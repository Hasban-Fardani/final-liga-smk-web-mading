<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
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
<body class="min-h-screen relative">
    <header>
        <x-navbar></x-navbar>
    </header>
    @if ($errors->any())
        <x-alert :message="$errors->all()[0]" type="error" />
            {{ $errors->all()[0] }}
    @endif
    
    <main>
        @yield("content")
    </main>
    <footer></footer>

    <script src="{{ asset('assets/js/main.js')}}"></script>
    @stack('js')
</body>
</html>