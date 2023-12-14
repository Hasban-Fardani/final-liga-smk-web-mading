<!-- The only way to do great work is to love what you do. - Steve Jobs -->
@extends('layout.admin')
@section('content')
    <div class="px-6 py-3">
        <h2 class="text-3xl font-medium">Posts</h2>
        <div class="border-t-2 border-gray-300 mb-6"></div>
        <table id="dataTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Views</th>
                    <th>Published At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td><img src="{{ $post->image }}" alt="{{ $post->title }}" width="150" height="150" class="object-cover"></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->views }}</td>
                        <td>{{ $post->published_at }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
