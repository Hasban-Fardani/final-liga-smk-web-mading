<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- Fontawesome css --}}
    <link rel="stylesheet" href="{{ asset('pkg/fontawesome-6.5.1/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('pkg/DataTables/DataTables-1.13.8/css/dataTables.foundation.css') }}">

    <link rel="stylesheet" href="{{ asset('pkg/DataTables/Buttons-2.4.2/css/buttons.dataTables.min.css') }}">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin.js'])

    {{-- custom css --}}
    @stack('css')
</head>

<body class="min-h-screen relative">
    <header>
        <x-navbar></x-navbar>
    </header>
    <x-login-modal />
    <x-user-dropdown />
    @if ($errors->any())
        <x-alert :message="$errors->all()[0]" type="error" />
        {{ $errors->all()[0] }}
    @endif

    <main>
        @yield('content')
    </main>
    <footer>
        <x-footer></x-footer>
    </footer>

    {{-- JQuery --}}
    <script src="{{ asset('pkg/jQuery-3.7.0/jquery-3.7.0.min.js') }}"></script>

    {{-- Datatables --}}
    <script src="{{ asset('pkg/DataTables/datatables.min.js') }}"></script>

    {{-- Datatables buttons --}}
    <script src="{{ asset('pkg/DataTables/Buttons-2.4.2/js/buttons.dataTables.min.js') }}"></script>

    {{--  --}}
    <script src="{{ asset('pkg/DataTables/pdfmake-0.2.7/pdfmake.min.js') }}"></script>
    <script src="{{ asset('pkg/DataTables/pdfmake-0.2.7/vfs_fonts.js') }}"></script>
    <script src="{{ asset('pkg/DataTables/JSZip-3.10.1/jszip.min.js') }}"></script>

    {{-- app script --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('js')
</body>

</html>
