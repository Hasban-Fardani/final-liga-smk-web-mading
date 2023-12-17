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
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    {{-- <link rel="stylesheet" href="{{ asset('pkg/DataTables/Buttons-2.4.2/css/buttons.dataTables.min.css') }}"> --}}

    {{-- video player --}}
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet" />

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- chart js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- custom css --}}
    @stack('css')

    @stack('headjs')
</head>

<body class="md:min-h-screen flex flex-col relative overflow-y-hidden">
    <header>
        <nav class="bg-gray-800 w-full flex justify-between items-center px-6 md:px-12 lg:px-6 py-4 relative">
            <h1 class="text-2xl text-white font-bold ">
                {{-- <i class="fa-solid fa-house"></i> --}}
                MADIG
                {{ auth()->user()->role->permission == 'admin' ? 'ADMIN' : 'CREATOR' }}</h1>
                
                <div class="text-md text-white items-center gap-3 hidden lg:flex">
                    <p class="flex">
                        <span>@</span> {{ auth()->user()->username }}
                    </p>
                    <div class="bg-gray-200 rounded-full h-8 w-8 flex items-center justify-center">
                        <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="rounded-full h-full w-full">
                    </div>
                </div>
            <button id="humburger" name="humburger" type="button" class="block absolute right-6 md:right-12 md:hidden">
                <span class="humburger-line transition duration-300 ease-in-out origin-top-left"></span>
                <span class="humburger-line transition duration-300 ease-in-out"></span>
                <span class="humburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
            </button>

            <div id="nav-menu"
                class="hidden absolute bg-white shadow-lg rounded-lg max-w-[150px] w-1/3 right-12 transition-all duration-200 top-full">
                <div class="flex flex-col gap-3 px-6 py-3 lg:hidden">
                    <a href="{{ route('index') }}"
                        class="hover:text-gray-800 hover:bg-white w-full flex gap-2 items-center">
                        <i class="fa-solid fa-house"></i>
                        Home
                    </a>

                    <a href="{{ auth()->user()->permission == 'admin' ? route('admin.dashboard') : route('creator.dashboard') }}"
                        class="hover:text-gray-800 hover:bg-white w-full flex gap-2 items-center">
                        <i class="fa-solid fa-chart-line w-4"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('posts.index') }}"
                        class="hover:text-gray-800 hover:bg-white w-full flex gap-2 items-center">
                        <i class="fa-solid fa-newspaper w-4"></i>
                        Posts
                    </a>
                    {{-- categories (soon) --}}
                    {{-- <a href="{{ route('categories.index') }}"
                        class="hover:text-gray-800 hover:bg-white w-full flex gap-2 items-center">
                        <i class="fa-solid fa-newspaper w-4"></i>
                        Categories
                    </a> --}}
                    @can('admin')
                        <a href="{{ route('admin.users') }}"
                            class="hover:text-gray-800 hover:bg-white w-full flex gap-2 items-center">
                            <i class="fa-solid fa-user w-4"></i>
                                User
                        </a>
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


    <main class="flex flex-col md:flex-row w-full h-screen">
        <aside class="bg-gray-800 text-white hidden md:flex flex-col w-[12%] min-w-[150px] h-full justify-between">
           <div class="flex flex-col">
                <a href="{{ route('index') }}"
                    class="px-6 py-3 hover:text-gray-800 hover:bg-white w-full flex gap-2 items-center">
                    <i class="fa-solid fa-house"></i>Home
                </a>

                <a href="{{ auth()->user()->permission == 'admin' ? route('admin.dashboard') : route('creator.dashboard') }}"
                    class="px-6 py-3 hover:text-gray-800 hover:bg-white w-full flex gap-2 items-center {{ request()->routeIs('admin.dashboard') ? 'bg-white text-gray-800' : ''}}">
                    <i class="fa-solid fa-chart-line w-4"></i>
                    Dashboard
                </a>
                <a href="{{ route('posts.index') }}"
                    class="px-6 py-3 hover:text-gray-800 hover:bg-white w-full flex gap-2 items-center {{ request()->routeIs('posts.index') ? 'bg-white text-gray-800' : ''}}">
                    <i class="fa-solid fa-newspaper w-4"></i>
                    Posts
                </a>
                @can('admin')
                    <a href="{{ route('admin.users') }}"
                        class="px-6 py-3 hover:text-gray-800 hover:bg-white w-full flex gap-2 items-center {{ request()->routeIs('admin.users') ? 'bg-white text-gray-800' : ''}}">
                        <i class="fa-solid fa-user w-4"></i>
                        Users
                    </a>
                @endcan
                <form action="{{ route('logout') }}" method="POST" >
                    @csrf
                    
                    <button type="submit" class="px-6 py-3 hover:text-gray-800 hover:bg-white w-full flex gap-2 items-center">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>
        <div class="flex-grow overflow-x-auto">
            @yield('content')
        </div>
    </main>

    {{-- JQuery --}}
    <script src="{{ asset('pkg/jQuery-3.7.0/jquery-3.7.0.min.js') }}"></script>

    {{-- Datatables --}}
    <script src="{{ asset('pkg/DataTables/datatables.min.js') }}"></script>

    {{-- Datatables buttons --}}
    <script src="{{ asset('pkg/DataTables/Buttons-2.4.2/js/buttons.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

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

        // close nav menu when click outside
        window.addEventListener('click', (e) => {
            if (e.target.id !== 'humburger' && e.target.id !== 'nav-menu') {
                navMenu.classList.add('hidden');
                humburger.classList.remove('humburger-active');
            }
        })
    </script>

    @stack('js')
</body>

</html>
