<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

<nav class="bg-blue-500 w-full flex justify-between items-center px-6 md:px-12 lg:px-16 py-3 shadow-md relative z-10">
    {{-- search form --}}
    <div class="hidden md:flex justify-start items-start w-1/3">
        <form action="/" method="GET">
            <input type="text" name="search" id="search" value="{{ request('search') }}" class="rounded-md text-lg px-2 w-[80%]">
            <button type="submit"><i class="fa-solid fa-magnifying-glass p-1 text-white"></i></button>
        </form>
    </div>


    <h1 class="flex justify-start lg:justify-center text-2xl text-white text-center font-bold w-1/3"><a href="/">Majalah Digital</a></h1>


    {{-- button dropdown on small --}}
    <div class="flex items-center">
        <button id="humburger" name="humburger" type="button" class="block absolute right-6 md:right-12 lg:hidden">
            <span class="humburger-line transition duration-300 ease-in-out origin-top-left"></span>
            <span class="humburger-line transition duration-300 ease-in-out"></span>
            <span class="humburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
        </button>
    </div>
    
    <div class="hidden absolute p-5 bg-white shadow-lg rounded-lg max-w-[150px] w-1/3 right-12 transition-all duration-200 md:right-16 lg:right-20 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:rounded-none lg:shadow-none lg:p-0"
        id="nav-menu">
        <ul class="block lg:flex justify-end items-center gap-6" id="nav-menu">

            <li class="group"><a href="{{ route('index') }}" class="link-nav">Home</a></li>
            <li class="group"><a href="{{ route('about') }}" class="link-nav">About</a></li>
            @auth
                <li>
                    <x-user-dropdown />
                </li>
            @else
                <li class="group"><a onclick="login_modal.showModal()" class="link-nav">Login</a></li>
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

        // profile detail modal
        function toggleProfileModal() {
            
        }
    </script>
@endpush
