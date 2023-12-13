<!-- The only way to do great work is to love what you do. - Steve Jobs -->
<div class="flex flex-col gap-6">
    @foreach ($posts as $post)
    <a href="{{ route('posts.read', $post->slug) }}" class="group">
        <div class="flex flex-col gorup">
            <h2 class="text-xl truncate group-hover:underline">{{ $post->title }}</h2>
            <h3 class="text-sm group ">{{ $post->excerpt }}</h3>
            <div class="flex w-full justify-between gap-3 group ">
                <p class="text-sm">{{ $post->creator->username }}</p>
                <p class="text-sm">{{ $post->created_at->diffForHumans() }}</p>
            </div>
        </div>
        <hr>
    </a>
    @endforeach
</div>