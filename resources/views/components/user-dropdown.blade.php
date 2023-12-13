<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->

<div id="user_dropdown" class="flex flex-col items-start justify-start">
    <button onclick="toggleUserDropdown()" class="text-black lg:text-white">User <i class="fa-solid fa-caret-down"></i></button>
    <ul id="user_dropdown_content" class="hidden w-[150px] bg-white absolute px-6 py-3 shadow-lg right-0 top-[80%] lg:top-full rounded-lg lg:right-16 z-10">
        @can('admin')
            <li class="group"><a href="{{ route('admin.dashboard') }}" class="text-black group-hover:text-blue-500">Dashboard</a></li>
        @endcan
        <li class="group"><a href="{{ route('posts.saved') }}" class="text-black group-hover:text-blue-500">Saved</a></li>
        {{-- <li class="group"><a href="{{ route('profile') }}" class="link-nav">Profile</a></li> --}}
        {{-- <li class="group"><a href="{{ route('settings') }}" class="link-nav">Settings</a></li> --}}
        <li class="group">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" value="Logout" class="text-black group-hover:text-blue-500">Logout</button>
            </form>
        </li>
    </ul>
</div>
@push('js')
    <script>
        const userDropdown = document.getElementById('user_dropdown_content');
        const icon = document.querySelector('i');

        function toggleUserDropdown() {
            userDropdown.classList.toggle('hidden');
            if (icon.classList.contains('fa-caret-up')) {
                icon.classList.replace('fa-caret-up', 'fa-caret-down');
            } else {
                icon.classList.replace('fa-caret-down', 'fa-caret-up');
            }
        }
    </script>
@endpush
