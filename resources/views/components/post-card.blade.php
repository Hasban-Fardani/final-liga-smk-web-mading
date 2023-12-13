<!-- Life is available only in the present moment. - Thich Nhat Hanh -->
<div class="border w-full lg:max-w-[300px] flex flex-col group">
    
        {{-- <span class="absolute z-10 top-3 left-3"><img src="assets/images/new-orange.png" alt="icon new"></span> --}}
        <img src="{{ $post->image }}" alt="{{ $post->title }}" loading="lazy" class="lg:brightness-75 lg:group-hover:scale-105 lg:group-hover:brightness-100 group-hover:shadow-lg transition-all duration-200">
    
    <div class="flex flex-col flex-grow justify-between gap-2 p-6 group">
        <h3 class="text-sm mt-1 flex-grow truncate">{{ $post->title }}</h3>
        <p class="text-xs font-semibold text-purple-800">{{ $post->author }}</p>
        
        <div class="flex truncate">
            @foreach ($post->tags as $post_tag)
            <p class="text-xs">{{ $post_tag->tag->name }}</p>
            @endforeach
        </div>

        <a class="btn w-28 mt-auto text-xs" href="{{ route('posts.read', $post->slug) }}">Selengkapnya</a>
    </div>
</div>
