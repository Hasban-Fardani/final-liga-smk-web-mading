<!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
@extends('layout.app')
@section('content')
<div class="p-6 lg:p-12 flex flex-col justify-center">
    <img src="{{ $post->image }}" alt="" class="max-h-96 w-full object-cover">
    <div class="mt-6">
        <div class="flex flex-wrap gap-2 text-gray-500">
            <p class="text-lg">{{ $post->creator->username }}</p>
            <span>|</span>
            <p class="text-lg">{{ $post->category->name }}</p>
            <span>|</span>
            <p class="text-lg">{{ $post->published_at }}</p>
        </div>
        <div class="flex gap-2 text-gray-500 text-xs">
            @foreach ($post->tags as $tag)
                <x-tag :name="$tag->tag->name" />
            @endforeach
        </div>
        <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
    </div>
    <p class="mt-4">
        {!! $post->body !!}
    </p>
</div>

@endsection
