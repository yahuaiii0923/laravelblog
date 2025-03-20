@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class="text-6xl">
            Blog Posts
        </h1>
    </div>

    <!-- Search Bar -->
    <div class="mb-5">
        <input
            type="text"
            id="search"
            class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Search for posts...">
    </div>
</div>

@if (session()->has('message'))
    <div class="w-4/5 m-auto mt-10 pl-2">
        <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
            {{ session()->get('message') }}
        </p>
    </div>
@endif

@if (Auth::check())
    <div class="pt-8 w-4/5 m-auto mb-10 relative z-10">
        <a
            href="/blog/create"
            class="bg-blue-500 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
            Create post
        </a>
    </div>
@endif

<!-- Post List (Scrollable) -->
<div class="overflow-y-auto h-96 border border-gray-200 rounded-md p-5 w-4/5 mx-auto">
    @foreach ($posts as $post)
        <!-- Clickable Blog Post Container -->
        <div class="flex items-center border-b border-gray-300 pb-5 mb-5 cursor-pointer blog-post-container"
             onclick="window.location='/blog/{{ $post->slug }}'">
            <!-- Image Container with Fixed Size -->
            <div class="w-24 h-24 bg-gray-300 rounded-md mr-5 flex-shrink-0">
                <!-- Image with object-cover to maintain aspect ratio -->
                <img src="{{ asset('images/' . $post->image_path) }}" alt=""
                     class="object-cover w-full h-full rounded-md">
            </div>

            <div>
                <a href="{{ route('posts.show', $post->slug) }}" class="block hover:text-blue-500">
                    <h2 class="text-xl font-bold text-gray-700">{{ $post->title }}</h2>
                </a>
                <p class="text-gray-500 text-sm mt-2">{{ Str::limit($post->excerpt, 100, '...') }}</p>
                <p class="text-gray-400 text-xs mt-1">Published on {{ $post->created_at->format('M d, Y') }}</p>
            </div>

            <!-- Edit and Delete buttons (visible only to the user who created the post) -->
            @if (Auth::check() && Auth::user()->id === $post->user_id)
                <div class="ml-auto flex items-center">
                    <!-- Edit Button -->
                    <a href="/blog/{{ $post->slug }}/edit"
                       class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2 mr-3">
                        Edit
                    </a>
                    <!-- Delete Button -->
                    <form action="/blog/{{ $post->slug }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach
</div>

@endsection
