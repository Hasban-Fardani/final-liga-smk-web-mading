<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

<nav class="bg-blue-500 w-full flex justify-between items-center px-12 md:px-16 lg:px-20 py-3 shadow-md ">
    <h1 class="text-2xl text-white font-bold">Madig</h1>
    <ul class="flex items-center gap-4">
        <li><a href="" class="link-white">Home</a></li>
        <li><a href="" class="link-white">About</a></li>
        @auth
            @if (auth()->user()->is_admin)
                <li><a href="{{ route('admin.dashboard') }}"
                        class="link-white text-gray-700 hover:underline hover:text-gray-400">Dashboard</a></li>
            @else
                <li>
                    <button class="flex flex-col items-center justify-center text-white" onclick="user_dropdown.show()">
                        <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->username }}'s avatar" width="20" class="text-white">
                    </button>
                </li>
            @endif
        @else
            <li><button onclick="login_modal.showModal()" class="link-white">Login</button></li>
        @endauth
    </ul>
</nav>

<x-login-modal />
<x-user-dropdown />