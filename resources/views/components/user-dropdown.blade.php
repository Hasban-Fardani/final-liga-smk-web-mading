<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
@auth
    <div id="user_dropdown" class="hidden opacity-0 w-48 bg-white roundex-md absolute top-16 right-5 z-10 transition-opacity duration-200">
        <div class="flex flex-col justify-center gap-4 p-3 ">
            <div class="flex gap-2">
                <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->username }}'s avatar" width="20"
                    class="">
                <p class="">{{ auth()->user()->username }}</p>
            </div>
            <hr>
            <div class="flex flex-col gap-2">
                {{-- <a href="{{ route('profile') }}" class="link-white">Profile</a> --}}
                <a href="" class="link-black">Settings</a>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" value="Logout" class="">
            </form>
        </div>
    </div>
    @push('js')
        <script>
           
        </script>
    @endpush
@endauth

