@extends('layout.app')

@section('content')
    <x-slide :posts="$posts" />
    
    <div class="mt-12 grid grid-cols-4 gap-5 container">
        @foreach ($posts as $post)
            <x-post-card :post="$post" />
        @endforeach
    </div>
@endsection
