@extends('layout.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:px-16 lg:mt-8">

        <x-mini-slider :posts="$posts_slider" />

        <div class="px-6 mt-12 md:mt-0">
            <h2 class="text-2xl font-medium">Informasi Terbaru</h2>
            <div class="border-t-2 border-blue-300 mb-8"></div>
            <x-articles :posts="$posts_featured" />
        </div>
    </div>
    {{-- <x-slide :posts="$posts" /> --}}
    <div class="mt-12 flex flex-col justify-center items-center">
        <div class="flex flex-col lg:flex-row gap-3 flex-wrap items-center justify-between w-full lg:px-16">
            <h2 class="text-2xl font-bold text-center lg:text-start" id="posts">Semua Postingan</h2>
            <ul class="flex flex-wrap gap-8 justify-center items-center overflow-hidden">
                {{-- {{ $categories }} --}}
                @foreach ($categories as $category)
                    <li>
                        <a href="" class="">{{ $category->name }}</a>
                    </li>
                @endforeach

            </ul>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 gap-y-6 mt-12 px-3 lg:px-16">
            @foreach ($posts as $post)
                <x-post-card :post="$post" />
            @endforeach

        </div>
    </div>
@endsection
