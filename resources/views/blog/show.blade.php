@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto mt-20 text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class="text-6xl">
            {{ $post->title }}
        </h1>
    </div>
</div>

<div class="w-4/5 m-auto pt-20">
    <!-- Blog Post Image -->
    @foreach($post->images as $image)
        <img src="{{ asset('storage/' . $image->image_path) }}"
             alt="Post image"
             class="mb-4 rounded-lg shadow-md">
    @endforeach

    <!-- Blog Post Content -->
    <div class="prose max-w-none">
        {!! $post->content !!}
    </div>

    <!-- Published Date -->
    <div class="text-gray-500 text-sm">
        Published on {{ $post->created_at->format('M d, Y') }}
    </div>

    <!-- Edit and Delete Buttons (for post author) -->
    @if (Auth::check() && Auth::user()->id === $post->user_id)
        <div class="mt-10">
            <a href="/blog/{{ $post->slug }}/edit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Edit Post
            </a>
            <form action="/blog/{{ $post->slug }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 ml-2">
                    Delete Post
                </button>
            </form>
        </div>
    @endif
</div>

{{-- Comments Section --}}
@if ($post)  <!-- Ensure $post is valid before showing comments -->
<div class="w-4/5 m-auto pt-20">
    <h2 class="text-3xl font-bold pb-2">Comments</h2>

    @foreach ($post->comments as $comment)
        <div class="border-b border-gray-200 mb-4 pb-2">
            <strong>{{ $comment->user->name }}</strong>
            <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
            <p class="mt-2">{{ $comment->content }}</p>
        </div>
    @endforeach

    {{-- Comments Form --}}
    @if(auth()->check())
        <form action="{{ url('/posts/' . $post->id . '/comments') }}" method="POST" class="mt-6">
            @csrf
            <textarea name="content" rows="3" class="-pl-20 w-full p-5 border border-gray-300 rounded-3xl focus:border-cyan-300 focus:ring-0 focus:outline-none transition-colors" placeholder="Add a comment..." required></textarea>
            <button type="submit" class="mt-6 mb-20 px-4 py-2 bg-cyan-400 text-white rounded-full hover:bg-cyan-600">Post Comment</button>
        </form>
    @else
        <p class="mt-5"><a href="{{ route('login') }}" class="text-blue-500">Log in to comment</a></p>
    @endif
</div>

@else
    {{-- If $post is null, show error message --}}
    <div class="w-4/5 m-auto text-center py-20">
        <h2 class="text-4xl text-red-500">Post Not Found</h2>
        <p class="text-gray-500 mt-3">The post you are looking for does not exist.</p>
        <a href="{{ url('/blog') }}" class="text-blue-500 mt-5 inline-block">Go back to blog</a>
    </div>
@endif

@endsection
