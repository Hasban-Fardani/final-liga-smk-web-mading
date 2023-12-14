<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- Fontawesome css --}}
    <link rel="stylesheet" href="{{ asset('pkg/fontawesome-6.5.1/css/all.min.css') }}">

    {{-- video js --}}
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet" />

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- custom css --}}
    @stack('css')
</head>

<body class="min-h-screen relative overflow-x-hidden">
    <header>
        <x-navbar></x-navbar>
        <x-login-modal />
    </header>
    @if ($errors->any())
        <x-alert :message="$errors->all()[0]" type="error" />
    @endif

    @if ($m = session('error'))
        <x-alert :message="$m" type="error" />
    @endif

    @if ($m = session('success'))
        <x-alert :message="$m" type="success" />
    @endif

    @if ($m = session('info'))
        <x-alert :message="$m" type="info" />
    @endif
    <main>
        @yield('content')
    </main>
    <footer class="mt-12">
        <x-footer></x-footer>
    </footer>

    {{-- app script --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('js')
</body>

</html>
