@extends('layout.admin')

@section('content')
    <div class="px-6 py-3 w-full h-fit">
        <h2 class="text-3xl font-medium">Create Posts</h2>
        <div class="border-t-2 border-gray-300 mb-6"></div>

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data"
            class="flex flex-col gap-4 w-full h-fit pb-20">
            @csrf
            {{-- title --}}
            <div class="flex flex-col">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="border text-lg px-2 py-1 rounded-md">
            </div>

            {{-- slug --}}
            <div class="flex flex-col">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="border text-lg px-2 py-1 rounded-md">
            </div>

            {{-- category select input --}}
            <div class="flex flex-col">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="border text-lg px-2 py-1 rounded-md bg-white">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- tags --}}
            <div class="flex flex-col">
                <label for="tags">Tags (separated by comma ,)</label>
                <input type="text" id="tags" class="border text-lg px-2 py-1 rounded-md" name="tags">
            </div>


            {{-- image --}}
            <div class="flex flex-col">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="border text-lg px-2 py-1 rounded-md">
            </div>

            {{-- excerpt --}}
            <div class="flex flex-col">
                <label for="excerpt">Excerpt <span class="text-xs">(optional)</span></label>
                <input name="excerpt" id="excerpt" cols="30" rows="10"
                    class="border text-lg px-2 py-1 rounded-md">
            </div>

            {{-- published --}}
            <div class="flex flex-col">
                <label for="published">Publish</label>
                <div class="flex gap-4">
                    <div>
                        <input type="radio" value="now" name="publish" checked>
                        <label>now</label>
                    </div>
                    <div>
                        <input type="radio" value="schedule" name="publish">
                        <label>schedule</label>
                    </div>
                </div>
            </div>

            {{-- published time --}}
            <div class="flex flex-col">
                <label for="published_at">Published At</label>
                <input type="datetime-local" name="published_at" id="published_at"
                    class="border text-lg px-2 py-1 rounded-md" value="" disabled>
            </div>

            <textarea id="tinymce" name="body"></textarea>

            <button type="submit"
                class="bg-blue-500 text-white px-4 py-1 rounded-md hover:bg-blue-700 mt-4">Create</button>
        </form>
    </div>
@endsection
@push('js')
    <script>
        const title = document.getElementById('title');
        const slug = document.getElementById('slug');

        title.addEventListener('change', function() {
            fetch("{{ route('slug') }}?title=" + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        const published = document.querySelectorAll('input[name=publish]');
        const published_at = document.querySelector('input[name=published_at]');
        published.forEach(i => {
            i.addEventListener('click', function() {
            console.log(i.value, published_at);
            if (i.value == 'now') {
                published_at.setAttribute('disabled', true);
            } else {
                published_at.removeAttribute('disabled');
                console.log('removing');
            }
        })
        })
    </script>
@endpush
@push('headjs')
    <x-tiny-head />
@endpush
@push('js')
    <x-tiny-config />
@endpush
