@extends('layout.app')

@section('content')
<div class="flex flex-col">
    <div class="px-6 py-3">
        <h2 class="text-3xl font-medium">Saved</h2>
        <div class="border-t-2 border-gray-300 mb-6"></div>
    </div>
    
    <div class="px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
        @if ( $savedPosts->count() == 0 )
            <p class="flex flex-grow">No saved posts</p>
        @endif
        @foreach ( $savedPosts as $saved_post )
            
                <x-post-card :post="$saved_post->post"/>
            
        @endforeach
    </div>
</div>
@endsection