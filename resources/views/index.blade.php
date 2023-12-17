@extends('layout.app')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:px-16 lg:mt-8">

        {{-- slider --}}
        <div class="relative h-[90vh] md:h-[80vh] overflow-x-hidden slider">
            {{-- list --}}
            <div class="relative flex image-list">
                @foreach ($posts_slider as $post)
                    {{-- item --}}
                    <div class="absolute opacity-0 image-slide">

                        <img src="{{ $post->image }}" alt="{{ $post->title }}"
                            class="w-screen lg:w-[50vw] h-[90vh] md:h-[80vh] object-cover brightness-50" loading="lazy">
                        <a href="{{ route('posts.read', $post->slug) }}" class="description">
                            <div
                                class="absolute bottom-20 md:buttom-12 left-1/2 translate-x-[-50%] py-2 w-[90%] flex flex-col gap-2 justify-start">
                                <span class="text-white text-center">{{ $post->creator->username }} -
                                    {{ \Carbon\Carbon::parse($post->published_at)->diffForHumans() }}</span>
                                <p class="text-2xl text-white text-center font-medium truncate">
                                    {{ $post->title }}
                                </p>
                                <button class="text-white underline">Selengkapnya</button>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- button next / prev --}}
            <div class="absolute px-6 bottom-6 right-3 flex gap-2 z-10">
                <button class="w-10 h-10 bg-gray-300 border rounded-full" id="prev_btn"><i
                        class="fa-solid fa-chevron-left"></i></button>
                <button class="w-10 h-10 bg-gray-300 border rounded-full" id="next_btn"><i
                        class="fa-solid fa-chevron-right"></i></button>
            </div>

            {{-- indicator --}}
            <ul class="absolute left-16 transform -translate-x-1/2 bottom-6 flex gap-2 indicators z-10">
                <li class="w-2 h-2 rounded-full bg-white active-indicator"></li>
                @for ($i = 0; $i < count($posts_slider) - 1; $i++)
                    <li class="w-2 h-2 rounded-full bg-white"></li>
                @endfor
            </ul>
        </div>


        {{-- Featured Posts --}}
        <div class="px-6 mt-12 md:mt-0">
            <h2 class="text-2xl font-medium mt-2 lg:mt-0">Informasi Terbaru</h2>
            <div class="border-t-2 border-blue-300 mb-6"></div>
            <div class="flex flex-col gap-4">
                @foreach ($posts_featured as $post)
                    <div class="flex flex-col relative">
                        <a href="{{ route('posts.read', $post->slug) }}" class="group">
                            <h2 class="text-xl truncate mt-1 hover:underline">{{ $post->title }}</h2>
                        </a>
                        <div class="flex w-full justify-between gap-4 mt-1">
                            <p class="text-sm flex"><span>@</span> {{ $post->creator->username }}</p>
                            <div class="flex gap-2 w-52">
                                <form action="{{ route('posts.saved.store', $post->id) }}" method="POST">
                                    @csrf
                                    <button><i class="fa-solid fa-bookmark hover:text-blue-500"></i></button>
                                </form>
                                <p class="text-sm flex gap-1 items-center"><i
                                        class="fa-solid fa-eye"></i>{{ $post->views }} </p>
                                <p class="text-sm flex gap-1 items-center" title="test"><i
                                        class="fa-solid fa-clock"></i>{{ \Carbon\Carbon::parse($post->published_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-1">
                @endforeach
            </div>
        </div>
        {{-- end Featured Posts --}}
    </div>

    {{-- Posts --}}
    <div class="mt-12 flex flex-col justify-center items-center">
        <div class="flex flex-col lg:flex-row gap-3 flex-wrap items-center justify-between w-full lg:px-16">
            <h2 class="text-2xl font-bold text-center lg:text-start" id="posts">Postingan</h2>
            {{-- categories --}}
            <ul class="flex flex-wrap gap-4 justify-center items-center overflow-hidden">
                {{-- {{ $categories }} --}}
                <li><a href="/" class="{{ request()->category == null ? 'font-bold' : '' }}">Semua</a></li>
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('search', ['category' => $category->slug]) }}"
                            class="{{ request()->category == $category->slug ? 'font-bold' : '' }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
            {{-- end categories --}}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 gap-y-6 mt-12 px-3 lg:px-16">
            @if ($posts == null)
                <p class="md:col-span-2 lg:col-span-4">Tidak ada postingan</p>
            @else
                @foreach ($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            @endif

        </div>
    </div>
    {{-- end Posts --}}

@endsection


@push('css')
    <style>
        .active-slide {
            opacity: 1;
            z-index: 2;
        }

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
        window.onload = () => {
            const queryString = window.location.search;
            const parameters = new URLSearchParams(queryString);
            const search = parameters.get('search');
            const category = parameters.get('category');
            if (search || category) {
                // navigate to #content
                const element = document.getElementById('posts');
                element.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }

        const images = document.querySelectorAll('.image-slide');
        const indicator = document.querySelectorAll('.indicators li');
        const description = document.querySelectorAll('.description');

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
                    images[i].classList.add('active-slide');
                    indicator[i].classList.add('active-indicator');
                } else {
                    images[i].classList.remove('active-slide');
                    images[i].classList.add('opacity-0');
                    indicator[i].classList.remove('active-indicator');
                }
            }
        }

        updateSlider()

        setInterval(() => {
            next()
        }, 5000);

        prev_btn.addEventListener('click', prev);
        next_btn.addEventListener('click', next);

        indicator.forEach((item, i) => {
            item.addEventListener('click', () => {
                index = i;
                updateSlider()
            })
        })
    </script>
@endpush

{{-- @php
    Session::forget('error');
@endphp --}}