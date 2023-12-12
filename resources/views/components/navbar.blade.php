<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

<nav class="w-full flex justify-between items-center px-4 md:px-8 lg:px-12 py-3 shadow-md bg-blue-600 text-white">
    <h1 class="text-2xl font-bold">Mading</h1>
    <ul class="flex gap-2">
        @auth
            @if (auth()->user()->is_admin)
                <li><a href="{{route('admin.dashboard')}}" class="link text-gray-700 hover:underline hover:text-gray-400">Dashboard</a></li>
            @else
                <li><a href="">Saved</a></li>
            @endif
        @else
            <li><button onclick="login_modal.showModal()">Login</button></li>
        @endauth
    </ul>
</nav>

<x-login-modal/>