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

<body class="min-h-screen relative overflow-x-hidden flex flex-col">
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
    <main class="flex-grow">
        @yield('content')
    </main>
    <footer class="mt-12">
        <!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
        <div class="bg-slate-800 text-white p-6">
            <div class="flex justify-between items-center w-full">
                <h2>MADIG SEBELAS</h2>
                <p class="text-sm text-center">Copyright © 2023, Hasban Fardani</p>
                <ul class="flex gap-2">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('search') }}">Search</a></li>
                    <li><a href="{{ route('posts.saved') }}">Saved</a></li>
                </ul>
            </div>

        </div>
    </footer>
    <!-- An unexamined life is not worth living. - Socrates -->
    <dialog id="login_modal" class="p-5 rounded-md">
        <div class="w-full md:w-72 lg:w-96 h-[400px]">
            <h2 class="text-center text-xl font-semibold">Login To Your Account</h2>
            <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-6 mt-6">
                @csrf
                <div class="flex flex-col">
                    <label for="identity" id="identity_label">Email</label>
                    <input type="text" name="identity" id="identity" class="border text-lg px-2 py-1 rounded-md"
                        required>
                </div>
                <div class="flex flex-col">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="border text-lg px-2 py-1 rounded-md"
                        required>
                </div>
                <div class="text-center">
                    <div class="border-b mb-2"></div>
                    <p>Login With</p>
                    <div class="flex gap-2 justify-center mt-2">
                        <div>
                            <input type="radio" value="email" name="type" id="type_email" class="type_login"
                                checked>
                            <label for="admin" class="text-sm">Email</label>
                        </div>

                        <div>
                            <input type="radio" value="username" name="type" id="type_username"
                                class="type_login">
                            <label for="user" class="text-sm">Username</label>
                        </div>

                        <div>
                            <input type="radio" value="ni" name="type" id="type_ni" class="type_login">
                            <label for="user" class="text-sm">NIP/NIS</label>
                        </div>

                        <div>
                        </div>

                    </div>
                    <br>
                    <input type="submit" value="Login" class="btn">
                </div>
            </form>
        </div>
    </dialog>

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

        
        // Login
        login_modal.addEventListener("click", (event) => {
            const {
                left,
                right,
                top,
                bottom
            } = login_modal.getBoundingClientRect();
            const {
                clientX,
                clientY
            } = event;

            if (
                clientX < left ||
                clientX > right ||
                clientY < top ||
                clientY > bottom
            ) {
                login_modal.close();
            }
        });

        const type = document.querySelectorAll('.type_login');
        // add type evenlistener onchange
        type.forEach((item) => {
            item.addEventListener('change', () => {
                if (item.checked) {
                    identity_label.textContent = item.value.charAt(0).toUpperCase() + item.value.slice(1);
                }
            })
        })
    </script>
    @stack('js')
</body>

</html>
