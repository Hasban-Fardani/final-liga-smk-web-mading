@extends('layout.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:px-16 lg:mt-8">

        <x-slider-v2 :posts="$posts_slider" />

        <div class="px-6 mt-12 md:mt-0">
            <h2 class="text-2xl font-medium mt-2 lg:mt-0">Informasi Terpopuler</h2>
            <div class="border-t-2 border-blue-300 mb-6"></div>
            <x-articles :posts="$posts_featured" />
        </div>
    </div>

    <div class="mt-12 flex flex-col justify-center items-center">
        <div class="flex flex-col lg:flex-row gap-3 flex-wrap items-center justify-between w-full lg:px-16">
        <h2 class="text-2xl font-bold text-center lg:text-start" id="posts">Postingan</h2>
            <ul class="flex flex-wrap gap-4 justify-center items-center overflow-hidden">
                {{-- {{ $categories }} --}}
                <li><a href="/" class="{{ request()->category == null ? 'font-bold' : '' }}">Semua</a></li>
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('index', ['category' => $category->slug]) }}" class="{{ request()->category == $category->slug ? 'font-bold' : '' }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
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
        {{-- p: {{ auth()->user()->type }} --}}
    </div>
@endsection

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
                element.scrollIntoView();
            }

        }
    </script>
@endpush
