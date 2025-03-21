@extends('layouts.app')

@section('content')
<script src="https://cdn.tiny.cloud/1/127.0.0.1:8000/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<div class="w-4/5 mx-auto pt-10">
    <div class="mb-12 ml-1">
        <h1 class="text-6xl font-bold text-cyan-900">
            Create Post
        </h1>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-3xl">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="px-4 py-2 bg-red-100 text-red-700 rounded-lg mb-2">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/blog" method="POST" enctype="multipart/form-data" id="post-form">
        @csrf

        <!-- Title Input -->
        <div class="mb-8 rounded-3xl">
            <input
                type="text"
                name="title"
                placeholder="Blog Title"
                class="rounded-3xl w-full text-4xl font-bold border-b-2 border-gray-200 focus:outline-none focus:border-blue-500 py-4 pl-6">
        </div>

        <!-- Content Editor -->
        <div class="mb-8 border rounded-3xl bg-white shadow-sm rounded-3xl overflow-hidden">
            <textarea
                name="content"
                id="editor"
                placeholder="Write your content here..."
                class="w-full min-h-[500px]"></textarea>
        </div>

        <!-- Image Upload Section -->
        <div class="mb-8">
            <div class="bg-gray-50 p-6 rounded-3xl shadow-inner">
                <label class="inline-flex flex-col items-center px-6 py-3 bg-white rounded-lg shadow-md border border-cyan-400 cursor-pointer hover:bg-cyan-50 transition-colors">
                    <span class="text-cyan-400 font-medium">
                        Select Images
                    </span>
                    <input
                        type="file"
                        name="images[]"
                        multiple
                        accept="image/*"
                        class="hidden"
                        id="image-upload">
                </label>

                <!-- Image Preview Container -->
                <div class="flex flex-wrap gap-4 mt-6" id="image-preview"></div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-right">
            <button
                type="submit"
                class="px-8 py-3 bg-cyan-400 text-white font-bold rounded-3xl hover:bg-cyan-700 transition-colors">
                Publish Post
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // TinyMCE Editor Configuration
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#editor',
            plugins: 'lists link autoresize',
            toolbar: 'undo redo | bold italic | bullist numlist | link',
            menubar: false,
            min_height: 500,
            content_style: `
                body {
                    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
                    font-size: 16px;
                    line-height: 1.6;
                    padding: 20px;
                }
            `,
            branding: false,
            setup: function(editor) {
                editor.on('init', function() {
                    this.getContainer().style.border = 'none';
                });
            }
        });
    });

    // Initialize files array
    let allFiles = [];

    document.getElementById('image-upload').addEventListener('change', function(e) {
        const newFiles = Array.from(e.target.files);
        allFiles = [...allFiles, ...newFiles]; // Merge existing and new files

        updatePreview();
        updateFileInput();
    });

    function updatePreview() {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = '';

        allFiles.forEach((file, index) => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            const card = document.createElement('div');
            card.className = 'relative group w-40 h-40 rounded-lg overflow-hidden shadow-md';

            reader.onload = (event) => {
                card.innerHTML = `
                    <img src="${event.target.result}"
                         class="w-full h-full object-cover"
                         alt="Preview">

                    <button type="button"
                            class="absolute top-2 right-2 w-6 h-6 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity"
                            data-index="${index}">
                        ×
                    </button>

                    <div class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-black/60 to-transparent">
                        <span class="text-xs text-white font-medium truncate">
                            ${file.name}
                        </span>
                    </div>
                `;

                card.querySelector('button').addEventListener('click', () => {
                    allFiles = allFiles.filter((_, i) => i !== index);
                    updatePreview();
                    updateFileInput();
                });

                preview.appendChild(card);
            };
            reader.readAsDataURL(file);
        });
    }

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        allFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('image-upload').files = dataTransfer.files;
    }
</script>
@endpush
@endsection
