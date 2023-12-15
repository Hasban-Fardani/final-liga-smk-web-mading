<!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
@extends('layout.app')
@section('content')
<div class="p-8 lg:p-16 flex flex-col justify-center">
    <img src="{{ $post->image }}" alt="" class="max-h-96 w-full object-cover">
    <div class="mt-6">
        <p class="text-lg">{{ $post->creator->username }} - {{ $post->created_at->diffForHumans() }}</p>
        <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
        <div class="flex gap-2">
            @foreach ($post->tags as $tag)
                <x-tag :name="$tag->tag->name" />
            @endforeach
        </div>
    </div>
    <p class="mt-4">
        {!! $post->body !!}
    </p>
    <p>Kategori: {{ $post->category->name }}</p>
</div>

@endsection
