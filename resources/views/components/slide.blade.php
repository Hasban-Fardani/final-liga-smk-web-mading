<!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->

{{-- slider --}}
<div class="relative h-[90vh] slider">
    {{-- list --}}
    <div class="relative flex image-list w-full">
        @foreach ($posts as $post)
            {{-- item --}}
            <div class="absolute opacity-0 image-slide">
                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-screen max-w-full h-[92vh] object-cover" loading="lazy">
                <div class="absolute bottom-20 left-1/2 translate-x-[-50%] py-2 w-[90%] lg:w-[80%] flex flex-col gap-2 justify-center">
                    <p class="text-lg text-white text-center font-medium rounded-lg">
                        {{ $post->title }}
                    </p>
                    <button class="link-white">Selengkapnya</button>
                </div>
            </div>
        @endforeach
    </div>

    {{-- button next / prev --}}
    <div class="absolute w-full flex justify-between px-6 top-1/2">
        <button class="w-10 h-10 bg-gray-300 border rounded-full" id="prev_btn"><i
                class="fa-solid fa-chevron-left"></i></button>
        <button class="w-10 h-10 bg-gray-300 border rounded-full" id="next_btn"><i
                class="fa-solid fa-chevron-right"></i></button>
    </div>

    {{-- indicator --}}
    <ul class="absolute bottom-6 left-1/2 translate-x-[-50%] flex gap-2 indicators">
        <li class="w-2 h-2 rounded-full bg-white active-indicator"></li>
        @for ($i = 0; $i < $posts->count() - 1; $i++)
            <li class="w-2 h-2 rounded-full bg-white"></li>
        @endfor
    </ul>
</div>

@push('css')
    <style>
        .active-indicator {
            width: 20px;
        }

        .image-slide {
            transition: 200ms opacity ease-in-out;
        }


        .indicators li {
            transition: 200ms width ease-in-out;
        }
    </style>
@endpush

@push('js')
    <script>
        const images = document.querySelectorAll('.image-slide');
        const indicator = document.querySelectorAll('.indicators li');

        let index = 0;

        function next() {
            if (index < images.length - 1) {
                index++
            } else {
                index = 0
            }
            updateSlider()
        }

        function prev() {
            if (index > 0) {
                index--
            } else {
                index = images.length - 1
            }
            updateSlider()
        }

        function updateSlider() {
            for (let i = 0; i < images.length; i++) {
                if (i === index) {
                    images[i].classList.remove('opacity-0');
                    images[i].classList.add('opacity-100');
                    indicator[i].classList.add('active-indicator');
                } else {
                    images[i].classList.add('opacity-0');
                    images[i].classList.remove('opacity-100');
                    indicator[i].classList.remove('active-indicator');
                }
            }
        }

        updateSlider()

        setInterval(() => {
            next()
        }, 3000);

        prev_btn.addEventListener('click', prev);
        next_btn.addEventListener('click', next);

        indicator.forEach((item, i) => {
            item.addEventListener('click', () => {
                index = i;
            })
        })
    </script>
@endpush
