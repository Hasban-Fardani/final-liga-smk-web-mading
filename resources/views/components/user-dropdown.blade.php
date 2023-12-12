<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
@auth
    <dialog id="user_dropdown" class="w-32 z-20 rounded-md">
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
                <input type="submit" value="Logout" class="btn">
            </form>
        </div>
    </dialog>
    @push('js')
        <script>
            user_dropdown.addEventListener("click", (event) => {
                const {
                    left,
                    right,
                    top,
                    bottom
                } = user_dropdown.getBoundingClientRect();
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
                    user_dropdown.close();
                }
            });
        </script>
    @endpush
@endauth

