<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    
    {{-- Fontawesome css --}}
    <link rel="stylesheet" href="{{ asset('pkg/fontawesome-6.5.1/css/all.min.css') }}">

    {{-- datatables --}}
    <link rel="stylesheet" href="{{ asset('pkg/DataTables/DataTables-1.13.8/css/dataTables.bootstrap5.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('pkg/DataTables/Buttons-2.4.2/css/buttons.dataTables.min.css') }}"> --}}
    
    {{-- video player --}}
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet" />
    
    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- custom css --}}
    @stack('css')
</head>

<body class="md:min-h-screen flex flex-col relative">
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


    <main class="flex md:flex-grow w-full">
        <aside class="bg-gray-800 text-white hidden md:flex flex-col w-1/6 min-w-[120px] ">
            <div class="flex flex-col gap-2 px-6 py-3">
                <a href="{{ auth()->user()->permission == 'admin' ? route('admin.dashboard') : route('creator.dashboard') }}"
                    class="px-3 hover:text-gray-800 hover:bg-white">Dashboard</a>
                <a href="{{ auth()->user()->permission == 'admin' ? route('admin.posts') : route('creator.posts') }}" class="px-3 hover:text-gray-800 hover:bg-white">Posts</a>
                @can('admin')
                    <a href="{{ route('admin.users') }}" class="px-3 hover:text-gray-800 hover:bg-white">User</a>
                @endcan
            </div>
        </aside>
        {{-- {{ auth()->user()->details()}} --}}
        @yield('content')
    </main>
    <footer>
        {{-- <x-footer></x-footer> --}}
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
    <script src="{{ asset('assets/js/datatable.js') }}" type="module"></script>

    @stack('js')
</body>

</html>
