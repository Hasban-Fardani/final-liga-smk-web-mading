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

            {{-- published time --}}
            <div class="flex flex-col">
                <label for="published_at">Published At</label>
                <input type="datetime-local" name="published_at" id="published_at"
                    class="border text-lg px-2 py-1 rounded-md" value="{{ now() }}">
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

        const input = document.getElementById('tags-input');
        new Tagify(input, {
            enforceWhitelist: true,
            whitelist: [], // Daftar tag yang tersedia (kosong awalnya)
            duplicates: false, // Mencegah duplikasi tag
            createTagOnBlur: true, // Membuat tag baru saat input kehilangan fokus
            dropdown: {
                enabled: 1, // Menampilkan dropdown dengan saran tag
                maxItems: 5 // Maksimum jumlah item dalam dropdown
            },
            callbacks: {
                add: async function(e) {
                    // Mengirim tag baru ke server jika tidak ada dalam daftar whitelist
                    if (!this.settings.whitelist.includes(e.detail.value)) {
                        const response = await fetch('/tags', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                tag: e.detail.value
                            })
                        });
                        const data = await response.json();
                        if (data.success) {
                            // Menambahkan tag baru ke daftar whitelist
                            this.settings.whitelist.push(e.detail.value);
                        } else {
                            // Menampilkan pesan error jika gagal menambahkan tag
                            console.error('Gagal menambahkan tag:', data.error);
                        }
                    }
                }
            }
        });
    </script>
@endpush
@push('headjs')
    <x-tiny-head />
@endpush
@push('js')
    <x-tiny-config />
@endpush
