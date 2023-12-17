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
        <nav
            class="bg-blue-500 w-full flex justify-between items-center px-6 md:px-12 lg:px-16 py-3 shadow-md relative z-10">



            <h1 class="flex justify-start lg:justify-start text-2xl text-white text-start font-bold w-1/2 md:w-1/3"><a
                    href="/">Majalah Digital</a></h1>

            {{-- search form --}}
            <div class="hidden md:flex justify-center items-center w-1/3">
                <form action="/search" method="GET">
                    <input type="text" name="q" id="q" value="{{ request('q') }}"
                        class="rounded-md text-lg px-2 w-[80%]">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass p-1 text-white"></i></button>
                </form>
            </div>

            {{-- button dropdown on small --}}
            <div class="flex items-center">
                <button id="humburger" name="humburger" type="button"
                    class="block absolute right-6 md:right-12 lg:hidden">
                    <span class="humburger-line transition duration-300 ease-in-out origin-top-left"></span>
                    <span class="humburger-line transition duration-300 ease-in-out"></span>
                    <span class="humburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
                </button>
            </div>

            <div class="hidden absolute p-5 bg-white shadow-lg rounded-lg max-w-[150px] w-1/3 right-12 transition-all duration-200 md:right-16 lg:right-20 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:rounded-none lg:shadow-none lg:p-0"
                id="nav-menu">
                <ul class="block lg:flex justify-end items-center gap-6" id="nav-menu">

                    <li class="group"><a href="{{ route('index') }}"
                            class="link-nav {{ request()->routeIs('index') ? 'active' : '' }}">Home</a></li>
                    <li class="group"><a href="{{ route('search') }}" class="link-nav">Search</a></li>
                    @auth
                        <li>
                            {{-- userdropdown --}}
                            <div id="user_dropdown" class="flex flex-col items-start justify-start">
                                <button onclick="toggleUserDropdown()"
                                    class="text-black lg:text-white flex gap-2 items-center"><i
                                        class="fa-solid fa-user"></i>{{ auth()->user()->username }} <i
                                        class="fa-solid fa-caret-down" id="icon_dropdown"></i></button>
                                <ul id="user_dropdown_content"
                                    class="hidden max-w-[150px] bg-white absolute px-6 py-3 shadow-lg right-0 top-[80%] lg:top-full rounded-lg lg:right-16 z-10">
                                    @can('admin')
                                        <li class="group"><a href="{{ route('admin.dashboard') }}"
                                                class="text-black group-hover:text-blue-500">Dashboard</a></li>
                                    @endcan
                                    @can('creator')
                                        <li class="group"><a href="{{ route('creator.dashboard') }}"
                                                class="text-black group-hover:text-blue-500">Dashboard</a></li>
                                    @endcan
                                    <li class="group"><a href="{{ route('posts.saved') }}"
                                            class="text-black group-hover:text-blue-500">Saved</a></li>
                                    <li class="group">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" value="Logout"
                                                class="text-black group-hover:text-blue-500">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            {{-- end user dropdown --}}
                        </li>
                    @else
                        <li class="group"><a onclick="login_modal.showModal()" class="link-nav">Login</a></li>
                    @endauth
                </ul>
            </div>
        </nav>
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
    <script>
        const userDropdown = document.getElementById('user_dropdown_content');
        const icon = document.querySelector('#icon_dropdown');

        function toggleUserDropdown() {
            userDropdown.classList.toggle('hidden');
            if (icon.classList.contains('fa-caret-up')) {
                icon.classList.replace('fa-caret-up', 'fa-caret-down');
            } else {
                icon.classList.replace('fa-caret-down', 'fa-caret-up');
            }
        }

        // humburger
        const humburger = document.getElementById('humburger');
        navMenu = document.getElementById('nav-menu');

        // humberger toggle
        humburger.addEventListener('click', () => {
            humburger.classList.toggle('humburger-active');
            navMenu.classList.toggle('hidden');
        })
    </script>
    @stack('js')
</body>

</html>
