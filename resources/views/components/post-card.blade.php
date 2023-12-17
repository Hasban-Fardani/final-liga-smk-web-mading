<!-- Life is available only in the present moment. - Thich Nhat Hanh -->
<div class="border w-full lg:max-w-[300px] max-h-[450px] flex flex-col group relative">
    
        {{-- <span class="absolute z-10 top-3 left-3"><img src="assets/images/new-orange.png" alt="icon new"></span> --}}
    <x-badge :text="$post->category->name" class="top-3 left-3" :color="$post->category->color"/>
        <img src="{{ $post->image }}" alt="{{ $post->title }}" loading="lazy" class="lg:brightness-75 lg:group-hover:scale-105 lg:group-hover:brightness-100 group-hover:shadow-lg transition-all duration-200 w-[100%] h-[45%] object-cover">
    
    <div class="flex flex-col flex-grow justify-between gap-2 p-6 group">
        <div class="flex gap-2 items-center text-xs">
            <p class="text-xs font-semibold text-gray-500">{{ '@'. $post->creator->username }}</p>
            <span>-</span>
            <a href="{{ route('search', ['category' => $post->category->slug])}}" class="text-xs font-semibold text-gray-500">{{ $post->category->name }}</a>
        </div>
        <h3 class="text-sm mt-1 font-medium truncate">{{ $post->title }}</h3>
        <div class="flex gap-2 truncate">
            @foreach ($post->tags as $post_tag)
            <x-tag :name="$post_tag->tag->name" />
            @endforeach
        </div>

        <div class="w-full flex justify-between">
            <a class="btn w-28 mt-auto text-xs" href="{{ route('posts.read', $post->slug) }}">Selengkapnya</a>
            @if (!Route::is('posts.saved'))

            <form action="{{ route('posts.saved.store', $post->id) }}" method="POST">
                @csrf
                <button><i class="fa-solid fa-bookmark hover:text-blue-500"></i></button>
            </form>
            @else
            <form action="{{ route('posts.saved.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="flex gap-1"><i class="fa-solid fa-minus text-xs group group-hover:text-red-500"></i><i class="fa-solid fa-bookmark group group-hover:text-red-500"></i></button>
            </form>
            @endif
        </div>
    </div>
</div>
