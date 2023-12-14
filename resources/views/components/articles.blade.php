<!-- The only way to do great work is to love what you do. - Steve Jobs -->
<div class="flex flex-col gap-3">
    @foreach ($posts as $post)
        <a href="{{ route('posts.read', $post->slug) }}" class="group">
            <div class="flex flex-col group relative">

                <x-badge :text="$post->category->name" position="relative" />

                <h2 class="text-xl truncate mt-1 group-hover:underline">{{ $post->title }}</h2>
                <div class="flex w-full justify-between gap-2 group ">
                    <p class="text-sm">{{ $post->creator->username }}</p>
                    <div class="flex gap-2">
                        <p class="text-sm flex gap-1 items-center"><i class="fa-solid fa-eye"></i>{{ $post->views }} </p>
                        <p class="text-sm flex gap-1 items-center"><i class="fa-solid fa-clock"></i>{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            <hr class="mt-2">
        </a>
    @endforeach
</div>
