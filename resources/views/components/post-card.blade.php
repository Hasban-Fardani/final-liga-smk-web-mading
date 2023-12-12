<!-- Life is available only in the present moment. - Thich Nhat Hanh -->
<div class="border w-64">
    <div class="relative">
        {{-- <span class="absolute z-10 top-3 left-3"><img src="assets/images/new-orange.png" alt="icon new"></span> --}}
        <img src="{{ $post->image }}" alt="{{ $post->title }}" loading="lazy">
    </div>
    <div class="flex flex-col p-6">
        <p class="text-xs font-semibold text-purple-800">{{ $post->author }}</p>
        <h3 class="text-sm mt-1">{{ $post->title }}</h3>

        <p class="text-xs">{{ $post->category->name }}</p>

        <a class="btn" href="{{ route('posts.read', $post->slug) }}">Selengkapnya</a>
    </div>
</div>
