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
        <nav class="bg-gray-800 w-full flex justify-between items-center px-6 md:px-12 lg:px-16 py-4 relative">
            <form action="" method="GET" class="hidden lg:block">
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class="rounded-md text-lg px-2 w-[80%]">
                <button type="submit"><i class="fa-solid fa-magnifying-glass p-1 text-white"></i></button>
            </form>
            <h1 class="text-2xl text-white font-bold">MADIG
                {{ auth()->user()->permission == 'admin' ? 'ADMIN' : 'CREATOR' }}</h1>
            <form action="{{ route('logout') }}" method="POST" class="hidden md:block">
                @csrf
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white rounded-md py-1 px-3">Logout</button>
            </form>

            <button id="humburger" name="humburger" type="button" class="block absolute right-6 md:right-12 md:hidden">
                <span class="humburger-line transition duration-300 ease-in-out origin-top-left"></span>
                <span class="humburger-line transition duration-300 ease-in-out"></span>
                <span class="humburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
            </button>

            <div id="nav-menu"
                class="hidden absolute p-5 bg-white shadow-lg rounded-lg max-w-[150px] w-1/3 right-12 transition-all duration-200 top-full">
                <div class="flex flex-col gap-2 px-6 py-3">
                    <a href="{{ auth()->user()->permission == 'admin' ? route('admin.dashboard') : route('creator.dashboard') }}"
                        class="px-3 hover:text-gray-800 hover:bg-white">Dashboard</a>
                <a href="{{ route('posts.index') }}"
                        class="px-3 hover:text-gray-800 hover:bg-white">Posts</a>
                    @can('admin')
                        <a href="{{ route('admin.users') }}" class="px-3 hover:text-gray-800 hover:bg-white">User</a>
                    @endcan
                    <form action="{{ route('logout') }}" method="POST" class="md:hidden">
                        @csrf
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white rounded-md py-1 px-3">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

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


    <main class="flex md:flex-grow w-full overflow-x-auto">
        <aside class="bg-gray-800 text-white hidden md:flex flex-col w-1/6 min-w-[120px] ">
            <div class="flex flex-col gap-2 px-6 py-3">
                <a href="{{ auth()->user()->permission == 'admin' ? route('admin.dashboard') : route('creator.dashboard') }}"
                    class="px-3 hover:text-gray-800 hover:bg-white">Dashboard</a>
                <a href="{{ route('posts.index') }}"
                    class="px-3 hover:text-gray-800 hover:bg-white">Posts</a>
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

    <script>
        // humburger
        const humburger = document.getElementById('humburger');
        navMenu = document.getElementById('nav-menu');

        humburger.addEventListener('click', () => {
            humburger.classList.toggle('humburger-active');
            navMenu.classList.toggle('hidden');
        })
    </script>

    @stack('js')
</body>

</html>
