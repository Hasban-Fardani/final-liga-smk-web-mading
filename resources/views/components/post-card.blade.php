<!-- Life is available only in the present moment. - Thich Nhat Hanh -->
<div class="border w-64 flex flex-col">
    <div class="relative">
        {{-- <span class="absolute z-10 top-3 left-3"><img src="assets/images/new-orange.png" alt="icon new"></span> --}}
        <img src="{{ $post->image }}" alt="{{ $post->title }}" loading="lazy">
    </div>
    <div class="flex flex-col flex-grow justify-between gap-2 p-6">
        <h3 class="text-sm mt-1 flex-grow">{{ $post->title }}</h3>
        <p class="text-xs font-semibold text-purple-800">{{ $post->author }}</p>
        
        <div class="flex">
            @foreach ($post->tags as $post_tag)
            <p class="text-xs">{{ $post_tag->tag->name }}</p>
            @endforeach
        </div>

        <a class="btn w-28 mt-auto text-xs" href="{{ route('posts.read', $post->slug) }}">Selengkapnya</a>
    </div>
</div>
