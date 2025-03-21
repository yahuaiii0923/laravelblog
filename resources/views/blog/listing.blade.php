@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-10">Jellycat Blog</h1>

        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto mb-8 relative">
            <input
                type="text"
                id="searchInput"
                class="w-full px-6 py-3 border-2 border-gray-200 rounded-full focus:outline-none focus:border-teal-500 transition-colors"
                placeholder="Search blog posts..."
                data-search-url="{{ route('blog.search') }}"
            >
            <svg class="w-6 h-6 absolute right-4 top-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>

        @if (session()->has('message'))
        <div class="bg-teal-100 border-l-4 border-teal-500 text-teal-700 p-4 rounded-lg mb-6" role="alert">
            <p>{{ session()->get('message') }}</p>
        </div>
        @endif
    </div>

    <!-- Admin Controls -->
    @can('manage-posts')
    <div class="text-center mb-8">
        <a href="{{ route('blog.create') }}" class="inline-flex items-center px-6 py-3 bg-cyan-400 text-white font-semibold rounded-full hover:bg-cyan-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create New Post
        </a>
    </div>
    @endcan

    <!-- Blog Posts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="postsContainer">
        @forelse($posts as $post)
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 post-item" data-title="{{ strtolower($post->title) }}">
            <a href="{{ route('posts.show', $post->slug) }}" class="block">
                <div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-t-2xl overflow-hidden">
                    <img
                        src="{{ $post->images->first() ? asset('storage/'.$post->images->first()->image_path) : asset('images/placeholder.jpg') }}"
                        alt="{{ $post->title }}"
                        class="object-cover w-full h-full transition-transform duration-300 hover:scale-105"
                        loading="lazy"
                    >
                </div>
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $post->excerpt }}</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $post->created_at->format('F j, Y') }}</span>
                    </div>
                </div>
            </a>

            @can('manage-posts')
            <div class="p-4 border-t border-gray-100 flex justify-end space-x-3">
                <a href="{{ route('blog.edit', $post->slug) }}" class="text-teal-600 hover:text-teal-700 flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('blog.destroy', $post->slug) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-700 flex items-center" onclick="return confirm('Are you sure?')">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
            @endcan
        </div>
        @empty
        <div class="col-span-2 text-center py-12">
            <p class="text-gray-500 text-lg">No blog posts found.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Search Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const postsContainer = document.getElementById('postsContainer');
    const postItems = document.querySelectorAll('.post-item');

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();

        postItems.forEach(item => {
            const title = item.dataset.title;
            if (title.includes(searchTerm)) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    });
});
</script>
@endsection
