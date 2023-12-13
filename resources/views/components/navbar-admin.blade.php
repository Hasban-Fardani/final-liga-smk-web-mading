<!-- When there is no desire, all things are at peace. - Laozi -->
<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

<nav class="bg-gray-800 w-full flex justify-between items-center px-6 md:px-12 lg:px-16 py-3 shadow-md relative">

    <h1 class="text-2xl text-white font-bold">Madig</h1>

    {{-- <button id="humburger" name="humburger" type="button" class="block absolute right-6 md:right-12">
        <span class="humburger-line transition duration-300 ease-in-out origin-top-left"></span>
        <span class="humburger-line transition duration-300 ease-in-out"></span>
        <span class="humburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
    </button> --}}
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
