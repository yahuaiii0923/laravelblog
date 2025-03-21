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

    <form action="{{ route('blog.update', $post) }}" method="POST" enctype="multipart/form-data" id="post-form">
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

        <!-- Image Management Section -->
        <div class="mb-8">
            <div class="bg-gray-50 p-6 rounded-3xl shadow-inner">
                <!-- Existing Images Preview -->
                @if($post->images->count() > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-cyan-900 mb-4">Current Images</h3>
                        <div class="flex flex-wrap gap-4" id="existing-images">
                            @foreach($post->images as $image)
                                <div class="relative group w-40 h-40 rounded-lg overflow-hidden shadow-md">
                                    <img src="{{ Storage::exists($image->path) ? asset('storage/'.$image->path) : $image->path }}"
                                         class="w-full h-full object-cover"
                                         alt="Existing image">
                                    <button type="button"
                                            class="absolute top-2 right-2 w-6 h-6 bg-red-500 text-white rounded-full opacity-75 hover:opacity-100 transition-opacity"
                                            onclick="handleImageDelete({{ $image->id }}, this)">
                                        ×
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- New Images Upload -->
                <div class="mb-6">
                    <label class="inline-flex flex-col items-center px-6 py-3 bg-white rounded-lg shadow-md border border-cyan-400 cursor-pointer hover:bg-cyan-50 transition-colors">
                        <span class="text-cyan-400 font-medium">
                            Add New Images
                        </span>
                        <input
                            type="file"
                            name="images[]"
                            multiple
                            accept="image/*"
                            class="hidden"
                            id="image-upload">
                    </label>
                </div>

                <!-- New Images Preview -->
                <div class="flex flex-wrap gap-4 mt-6" id="image-preview"></div>
            </div>
        </div>

        <!-- Hidden inputs for deleted images -->
        <div id="deleted-images-container"></div>

        <!-- Submit Button -->
        <div class="text-right">
            <button
                type="submit"
                class="px-8 py-3 bg-cyan-400 text-white font-bold rounded-3xl hover:bg-cyan-700 transition-colors">
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
            images_upload_handler: function (blobInfo, success, failure) {
                success('data:' + blobInfo.blob().type + ';base64,' + blobInfo.base64());
            },
            content_style: `
                body {
                    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
                    font-size: 16px;
                    line-height: 1.6;
                    padding: 20px;
                }
                img {
                    max-width: 100%;
                    height: auto;
                }
            `,
            branding: false
        });
    });

    // Image Handling
    let newFiles = [];
    const deletedImages = new Set();

    function handleImageDelete(imageId, element) {
        deletedImages.add(imageId);
        const container = document.getElementById('deleted-images-container');

        // Add hidden input for deleted image
        if (!document.querySelector(`input[name="delete_images[]"][value="${imageId}"]`)) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_images[]';
            input.value = imageId;
            container.appendChild(input);
        }

        // Fade out and remove image element
        element.parentElement.style.opacity = '0';
        setTimeout(() => element.parentElement.remove(), 300);
    }

    // New Images Handling
    document.getElementById('image-upload').addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        newFiles = [...newFiles, ...files];
        updatePreview();
        updateFileInput();
    });

    function updatePreview() {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = '';

        newFiles.forEach((file, index) => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            const card = document.createElement('div');
            card.className = 'relative group w-40 h-40 rounded-lg overflow-hidden shadow-md animate-fade-in';

            reader.onload = (event) => {
                card.innerHTML = `
                    <img src="${event.target.result}"
                         class="w-full h-full object-cover"
                         alt="Preview">
                    <button type="button"
                            class="absolute top-2 right-2 w-6 h-6 bg-red-500 text-white rounded-full opacity-75 hover:opacity-100 transition-opacity"
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
                    newFiles = newFiles.filter((_, i) => i !== index);
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
        newFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('image-upload').files = dataTransfer.files;
    }
</script>
<style>
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush
@endsection
