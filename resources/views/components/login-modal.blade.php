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
            <div>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </div>
            <div class="text-center">
                <div class="border-b"></div>
                <p>Login With</p>
                <div class="border-b"></div>
                <div class="flex gap-2 justify-center mt-2">
                    <div>
                        <input type="radio" value="email" name="type" id="type_email" class="type_login" checked>
                        <label for="admin" class="text-sm">Email</label>
                    </div>

                    <div>
                        <input type="radio" value="username" name="type" id="type_username" class="type_login">
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

@push('js')
    <script>
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
@endpush
