<!-- An unexamined life is not worth living. - Socrates -->
<dialog id="login_modal" class="p-5 rounded-md">
    <div class="w-full md:w-72 lg:w-96 h-[400px]">
        <h2 class="text-center text-xl font-semibold">Login To Your Account</h2>
        <form action="{{route('login')}}" method="POST" class="flex flex-col gap-6">
            @csrf
            <div class="flex flex-col">
                <label for="identity">Email</label>
                <input type="text" name="identiry" id="identiry" class="border text-lg p-1 rounded-md">
            </div>
            <div class="flex flex-col">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="border text-lg p-1 rounded-md">
            </div>
            <div>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </div>
            {{-- <div>
                
                    
            </div> --}}
            <br>
            <input type="submit" value="Login" class="btn">
        </form>
    </div>
</dialog>