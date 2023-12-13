@extends('layout.app')

@section('content')
    {{-- this is still bug, deprecated --}}
    {{-- <x-hero-article :posts="$posts"/> --}}
    
    <x-slide :posts="$posts" />
    <div class="mt-12">
        <h2 class="px-20">All Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 container">
            @foreach ($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>
    </div>
@endsection
