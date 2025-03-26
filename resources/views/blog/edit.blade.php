@extends('layouts.app')

@section('content')
<script src="https://cdn.tiny.cloud/1/127.0.0.1:8000/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<div class="w-4/5 mx-auto pt-10">
    <div class="mb-12 ml-1">
        <h1 class="text-6xl font-bold text-cyan-900">
            Update Post
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

    <form action="{{ route('blog.update', $post->slug) }}" method="POST" enctype="multipart/form-data" id="post-form">
        @csrf
        @method('PUT')

        <!-- Title Input -->
        <div class="mb-8 rounded-3xl">
            <input
                type="text"
                name="title"
                value="{{ $post->title }}"
                class="rounded-3xl w-full text-4xl font-bold border-b-2 border-gray-200 focus:outline-none focus:border-blue-500 py-4 pl-6">
        </div>

        <!-- Content Editor -->
        <div class="mb-8 border rounded-3xl bg-white shadow-sm overflow-hidden">
            <textarea
                name="content"
                id="editor"
                placeholder="Write your content here..."
                class="w-full min-h-[500px]">{{ $post->content }}</textarea>
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

        <!-- Combined Image Preview Container -->
        <div class="flex flex-wrap gap-4 mt-6" id="image-preview">
            <!-- Existing Images -->
            @foreach($post->images as $image)
                <div class="relative group w-40 h-40 rounded-lg overflow-hidden shadow-md existing-image">
                    <img src="{{ Storage::disk('public')->exists($image->image_path) ? asset('storage/'.$image->image_path) : $image->image_path }}"
                         class="w-full h-full object-cover"
                         alt="Existing image">
                    <button type="button"
                            class="absolute top-2 right-2 w-6 h-6 bg-red-500 text-white rounded-full opacity-75 hover:opacity-100 transition-opacity"
                            data-id="{{ $image->id }}">
                        ×
                    </button>
                </div>
            @endforeach
        </div>
    </div>
    @error('images.*')
        <div class="text-red-500 mt-2 text-sm">
            {{ $message }}
        </div>
    @enderror
</div>

<!-- Hidden container for new files tracking -->
<div id="file-inputs-container"></div>

        <!-- Hidden inputs for deleted images -->
        <div id="deleted-images-container"></div>

        <!-- Submit Button -->
        <div class="text-right">
            <button
                type="submit"
                class="mb-20 px-8 py-3 bg-cyan-400 text-white font-bold rounded-3xl hover:bg-cyan-700 transition-colors">
                Update Post
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // TinyMCE Initialization
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#editor',
            plugins: 'lists link image media autoresize',
            toolbar: 'undo redo | bold italic | bullist numlist | link image media',
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

// Initialize arrays for file management
let allFiles = [];
const deletedImages = new Set();

// Handle new image uploads
document.getElementById('image-upload').addEventListener('change', function(e) {
    const newFiles = Array.from(e.target.files);
    allFiles = [...allFiles, ...newFiles];
    updatePreview();
});

function updatePreview() {
    const preview = document.getElementById('image-preview');
    const dataTransfer = new DataTransfer();

    // Clear only new image previews (keep existing images)
    const existingPreviews = document.querySelectorAll('.existing-image');
    preview.innerHTML = '';
    existingPreviews.forEach(el => preview.appendChild(el));

    // Handle new files
    allFiles.forEach((file, index) => {
        if (!file.type.startsWith('image/')) return;
        dataTransfer.items.add(file);

        const reader = new FileReader();
        const card = document.createElement('div');
        card.className = 'relative group w-40 h-40 rounded-lg overflow-hidden shadow-md animate-fade-in';

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
            });

            preview.appendChild(card);
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('image-upload').files = dataTransfer.files;
}

// Handle existing image deletion
document.querySelectorAll('.existing-image button').forEach(button => {
    button.addEventListener('click', function() {
        const imageId = this.dataset.id;
        deletedImages.add(imageId);
        const container = document.getElementById('deleted-images-container');

        if (!document.querySelector(`input[name="delete_images[]"][value="${imageId}"]`)) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_images[]';
            input.value = imageId;
            container.appendChild(input);
        }

        this.closest('.existing-image').remove();
    });
});
</script>
    @endpush
    @endsection
