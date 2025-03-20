@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class="text-6xl">
            {{ $post->title }}
        </h1>
    </div>
</div>

<div class="w-4/5 m-auto pt-20">
    <!-- Blog Post Image -->
    <div class="w-full h-96 overflow-hidden mb-10">
        <img src="{{ asset('images/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
    </div>

    <!-- Blog Post Content -->
    <div class="prose max-w-none">
        {!! $post->content !!}
    </div>

    <!-- Published Date -->
    <div class="mt-10 text-gray-500 text-sm">
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
    <h2 class="text-3xl font-bold pb-5">Comments</h2>

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
            <textarea name="content" rows="3" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Add a comment..." required></textarea>
            <button type="submit" class="mt-3 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Post Comment</button>
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
