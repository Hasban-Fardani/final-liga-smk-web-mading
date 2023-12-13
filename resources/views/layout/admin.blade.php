<!-- He who is contented is rich. - Laozi -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fontawesome css --}}
    <link rel="stylesheet" href="{{ asset('pkg/fontawesome-6.5.1/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('pkg/DataTables/DataTables-1.13.8/css/dataTables.foundation.css') }}">

    <link rel="stylesheet" href="{{ asset('pkg/DataTables/Buttons-2.4.2/css/buttons.dataTables.min.css') }}">

    {{-- custom css --}}
    @stack('css')
</head>

<body class="min-h-screen flex flex-col relative">
    <header>
        <x-navbar-admin />
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


    <main class="flex flex-grow">
        <aside class="bg-gray-800 text-white flex flex-col w-1/6">
            <div class="px-6 py-3">
                <p>Hello</p>
                <p>Hello</p>
                <p>Hello</p>
            </div>
        </aside>
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

    <script src="{{ asset('assets/js/main.js') }}" type="module"></script>

    @stack('js')
</body>

</html>
