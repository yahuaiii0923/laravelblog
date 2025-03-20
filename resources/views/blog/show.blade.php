@extends('layouts.app')

@section('content')

@if ($post)
    {{-- ensure $post not null --}}
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl">
                {{ $post->title }}
            </h1>
        </div>
    </div>

    <div class="w-4/5 m-auto pt-20">
        <span class="text-gray-500">
            By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>,
            Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
        </span>

        <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
            {{ $post->description }}
        </p>
    </div>

    {{-- Comments Section --}}
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
    {{--if $post is null，show error message --}}
    <div class="w-4/5 m-auto text-center py-20">
        <h2 class="text-4xl text-red-500">Post Not Found</h2>
        <p class="text-gray-500 mt-3">The post you are looking for does not exist.</p>
        <a href="{{ url('/blog') }}" class="text-blue-500 mt-5 inline-block">Go back to blog</a>
    </div>
@endif

@endsection
