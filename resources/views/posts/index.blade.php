<!-- The only way to do great work is to love what you do. - Steve Jobs -->
@extends('layout.admin')
@section('content')
    <div class="px-6 py-3">
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
                        <th>Slug</th>
                        <th>Views</th>
                        <th>Status</th>
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
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->views }}</td>
                            <td>
                                {{ $post->status }}
                                @can('admin')
                                    @if ($post->status == 'PENDING')
                                        <form action="{{ route('admin.publish', $post->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="text-sm hover:font-semibold underline">publish</button>
                                        </form>
                                    @endif
                                @endcan

                            </td>
                            <td>{{ $post->published_at }}</td>
                            <td>
                                <button><a href="{{ route('posts.edit', $post->id) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></a></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
