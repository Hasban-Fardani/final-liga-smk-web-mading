<!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->

{{-- slider --}}
<div class="relative h-[90vh] slider">
    {{-- list --}}
    <div class="relative flex items-center justify-center -z-10 top-0 overflow-hidden image-list">
        @foreach ($posts as $post)
            {{-- item --}}
            <div class="image">
                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-screen max-w-full h-[92vh] object-cover">
                <p class="absolute bottom-20 left-1/2 translate-x-[-50%] text-white py-2 w-[80%] bg-slate-400 text-center">{{ $post->title }}</p>
            </div>
        @endforeach
    </div>

    {{-- button next / prev --}}
    <div class="absolute w-full flex justify-between px-6 top-1/2">
        <button class="w-10 h-10 bg-white rounded-full"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="w-10 h-10 bg-white rounded-full"><i class="fa-solid fa-chevron-right"></i></button>
    </div>

    {{-- indicator --}}
    <ul class="absolute bottom-6 left-1/2 translate-x-[-50%] flex gap-2 indicator">
        <li class="w-2 h-2 rounded-full bg-white active-indicator"></li>
        @for ($i = 0; $i < $posts->count() - 1; $i++)
            <li class="w-2 h-2 rounded-full bg-white"></li>
        @endfor
    </ul>
</div>

@push('css')
    <style>
        .active-indicator {
            width: 16px;
        }

        .image-out {
            animation: slideOut 1s ease-in-out;
        }

        @keyframes slideOut {
            from {
                margin-righy: 0%;
            }

            to {
                margin-right: 100%;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        const images = document.querySelectorAll('.image');
        const indicator = document.querySelectorAll('.indicator li');

        let index = 0;

        console.log(images);

        function updateSlider() {
            for (let i = 0; i < images.length; i++) {
                if (i === index) {
                    images[i].classList.remove('hidden');
                    indicator[i].classList.add('active-indicator');
                } else {
                    images[i].classList.add('hidden');
                    indicator[i].classList.remove('active-indicator');
                }
            }
        }

        updateSlider()

        setInterval(() => {
            if (index >= images.length - 1) {
                index = 0
            } else {
                index++
            }
            updateSlider()
        }, 3000);
    </script>
@endpush
