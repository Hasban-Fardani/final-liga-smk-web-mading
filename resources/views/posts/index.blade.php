<!-- The only way to do great work is to love what you do. - Steve Jobs -->
@extends('layout.admin')
@section('content')
    <div class="px-6 pt-3 pb-20">
        <div class="flex">
            <h2 class="text-3xl font-medium">Posts</h2>
            <button class="bg-blue-500 text-sm text-white px-4 py-1 ml-6 rounded-md hover:bg-blue-700">
                <a href="{{ route('posts.create') }}">Create</a>
            </button>
        </div>
        <div class="border-t-2 border-gray-300 mt-2 mb-6"></div>
        <div class="overflow-x-auto">
            <table id="dataTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Views</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Published At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td><img src="{{ $post->image }}" alt="{{ $post->title }}" width="150" height="150"
                                    class="object-cover"></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->views }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($post->tags as $postTag)
                                       <x-tag :name="$postTag->tag->name" />
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                {{ $post->status }}
                                @can('admin')
                                    @if ($post->status == 'DRAFT' || $post->status == 'PENDING')
                                        <form action="{{ route('admin.publish', $post->id) }}" method="post">
                                            @csrf
                                            <button type="submit"
                                                class="text-sm hover:font-semibold underline">publish</button>
                                        </form>
                                    @endif
                                @endcan
                                @can('creator')
                                    @if ($post->status == 'DRAFT')
                                        <form action="{{ route('creator.request.admin', $post->id) }}" method="post">
                                            @csrf
                                            <button type="submit"
                                                class="text-sm hover:font-semibold underline">publish</button>
                                        </form>
                                    @endif
                                @endcan

                            </td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->published_at }}</td>
                            <td>
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('posts.edit', $post->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // funtion to confirm send form requests delete
        function confirmDelete() {
            let answer = confirm('Are you sure you want to delete this post?');
            if (!answer) {
                event.preventDefault();
            }
        }
    </script>
@endpush