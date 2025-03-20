@extends('layouts.app')

@section('content')
    <div class="w-4/5 mx-auto py-10">
        <!-- Search Bar -->
        <div class="mb-5">
            <input
                type="text"
                id="search"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Search for posts...">
        </div>

        <!-- Post List (Scrollable) -->
        <div class="overflow-y-auto h-96 border border-gray-200 rounded-md p-5">
            @foreach ($posts as $post)
                <div class="flex items-center border-b border-gray-300 pb-5 mb-5">
                    <!-- Placeholder Image -->
                    <div class="w-24 h-24 bg-gray-300 rounded-md mr-5 flex-shrink-0"></div>

                    <div>
                        <a href="{{ route('posts.show', $post->slug) }}" class="block hover:text-blue-500">
                            <h2 class="text-xl font-bold text-gray-700">{{ $post->title }}</h2>
                        </a>
                        <p class="text-gray-500 text-sm mt-2">{{ Str::limit($post->excerpt, 100, '...') }}</p>
                        <p class="text-gray-400 text-xs mt-1">Published on {{ $post->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
