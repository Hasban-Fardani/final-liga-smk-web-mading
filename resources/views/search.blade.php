@extends('layout.app')

@section('content')
    <div class="px-6 md:px-12 lg:px-16 py-6">
        <div class="flex flex-wrap justify-between w-full">
            <h1 class="text-2xl font-medium">Search Post</h1>
            <div>
                <ul class="flex flex-wrap gap-2 justify-start items-center">
                    <li><a href="{{route('search')}}" class="{{ request()->category == null ? 'font-bold' : '' }}">Semua</a></li>
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('search', ['category' => $category->slug, 'tag' => request()->tag]) }}"
                                class="{{ request()->category == $category->slug ? 'font-bold' : '' }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
                <ul class="flex flex-wrap gap-2 justify-start items-center">
                    <li>
                        <a href="{{ route('search') }}">
                        clear
                        </a>
                    </li>
                    @foreach ($tags as $tag)
                        <li>
                            <a href="{{ route('search', ['tag' => $tag->name, 'category' => request()->category]) }}"
                                class="{{ request()->tag == $tag->name ? 'font-bold' : '' }}">
                            <x-tag :name="$tag->name" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 gap-y-6 mt-12 px-3">
            @if ($posts == null || count($posts) == 0)
                <p class="md:col-span-2 lg:col-span-4 text-center">Tidak ada postingan</p>
            @else
                @foreach ($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            @endif

        </div>
    </div>
@endsection
