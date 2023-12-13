<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

<nav class="bg-blue-500 w-full flex justify-between items-center px-12 md:px-16 lg:px-20 py-3 shadow-md relative">
    <h1 class="text-2xl text-white font-bold">Madig</h1>

    {{-- humberger by pak dhika --}}
    {{-- button dropwon on small --}}
    <div class="flex items-center">
        <button id="humburger" name="humburger" type="button" class="block absolute right-16 lg:hidden">
            <span class="humburger-line transition duration-300 ease-in-out origin-top-left"></span>
            <span class="humburger-line transition duration-300 ease-in-out"></span>
            <span class="humburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
        </button>
    </div>
    <div class="hidden absolute p-5 bg-white shadow-lg rounded-lg max-w-[200px] w-full right-12 md:right-16 lg:right-20 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:rounded-none lg:shadow-none lg:p-0"
        id="nav-menu">
        <ul class="block lg:flex justify-end items-center gap-6" id="nav-menu">

            <li class="group"><a href="{{ route('index') }}" class="link-nav">Home</a></li>
            <li class="group"><a href="{{ route('about') }}" class="link-nav">About</a></li>
            @auth
                @if (auth()->user()->permission == 'admin')
                    <li class="group"><a href="{{ route('admin.dashboard') }}"
                            class="link-nav">Dashboard</a></li>
                @endif
                <li class="group">
                    <button class="flex items-center lg:flex-row-reverse gap-2 link-nav">
                        <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->username }}'s avatar" width="20"
                            class="text-white">
                            <p>{{ auth()->user()->username }}</p>
                    </button>
                </li>
                @else
                <li class="group"><button onclick="login_modal.showModal()" class="link-nav">Login</button></li>
            @endauth
        </ul>
    </div>
</nav>

@push('js')
    <script>
        // humburger
        const humburger = document.getElementById('humburger');
        navMenu = document.getElementById('nav-menu');

        humburger.addEventListener('click', () => {
            humburger.classList.toggle('humburger-active');
            navMenu.classList.toggle('hidden');
        })
    </script>
@endpush
