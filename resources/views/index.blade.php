@extends('layout.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:px-16 lg:mt-8">

        <x-slider :posts="$posts_slider" />

        {{-- Featured Posts --}}
        <div class="px-6 mt-12 md:mt-0">
            <h2 class="text-2xl font-medium mt-2 lg:mt-0">Informasi Terbaru</h2>
            <div class="border-t-2 border-blue-300 mb-6"></div>
            <div class="flex flex-col gap-4">
                @foreach ($posts_featured as $post)
                    <div class="flex flex-col relative">
                        <a href="{{ route('posts.read', $post->slug) }}" class="group">
                            <h2 class="text-xl truncate mt-1 hover:underline">{{ $post->title }}</h2>
                        </a>
                        <div class="flex w-full justify-between gap-4 mt-1">
                            <p class="text-sm flex"><span>@</span> {{ $post->creator->username }}</p>
                            <div class="flex gap-2 w-52">
                                <form action="{{ route('posts.saved.store', $post->id) }}" method="POST">
                                    @csrf
                                    <button><i class="fa-solid fa-bookmark hover:text-blue-500"></i></button>
                                </form>
                                <p class="text-sm flex gap-1 items-center"><i
                                        class="fa-solid fa-eye"></i>{{ $post->views }} </p>
                                <p class="text-sm flex gap-1 items-center" title="test"><i
                                        class="fa-solid fa-clock"></i>{{  \Carbon\Carbon::parse( $post->published_at)->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-1">
                @endforeach
            </div>
        </div>
        {{-- end Featured Posts --}}
    </div>

    {{-- Posts --}}
    <div class="mt-12 flex flex-col justify-center items-center">
        <div class="flex flex-col lg:flex-row gap-3 flex-wrap items-center justify-between w-full lg:px-16">
            <h2 class="text-2xl font-bold text-center lg:text-start" id="posts">Postingan</h2>
            {{-- categories --}}
            <ul class="flex flex-wrap gap-4 justify-center items-center overflow-hidden">
                {{-- {{ $categories }} --}}
                <li><a href="/" class="{{ request()->category == null ? 'font-bold' : '' }}">Semua</a></li>
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('index', ['category' => $category->slug]) }}"
                            class="{{ request()->category == $category->slug ? 'font-bold' : '' }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
            {{-- end categories --}}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 gap-y-6 mt-12 px-3 lg:px-16">
            @if ($posts == null)
                <p class="md:col-span-2 lg:col-span-4">Tidak ada postingan</p>
            @else
                @foreach ($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            @endif

        </div>
    </div>
    {{-- end Posts --}}
    
@endsection

@push('js')
    <script>
        window.onload = () => {
            const queryString = window.location.search;
            const parameters = new URLSearchParams(queryString);
            const search = parameters.get('search');
            const category = parameters.get('category');
            if (search || category) {
                // navigate to #content
                const element = document.getElementById('posts');
                element.scrollIntoView({ behavior: 'smooth' });
            }

        }

        
    </script>
@endpush
