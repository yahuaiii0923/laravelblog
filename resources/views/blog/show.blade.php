@extends('layouts.app')

@section('content')
<div class="w-10/12 m-auto mt-16 text-center">
    <div class="py-15 pb-16 border-b border-gray-200 ">
        <h1 class="text-6xl font-semibold">
            {{ $post->title }}
        </h1>
    </div>
</div>

<div class="w-10/12 m-auto pt-20">
   <!-- Image Carousel -->
   @if($post->images->count() > 0)
   <div class="relative mb-12 group" x-data="{ activeSlide: 0 }" x-cloak>
       <!-- Slider Container -->
       <div
           class="rounded-3xl flex overflow-x-auto snap-mandatory snap-x h-[750px] scrollbar-hide"
           x-ref="slider"
           @scroll.debounce.16ms="activeSlide = Math.round($event.target.scrollLeft / $event.target.offsetWidth)"
           style="scroll-behavior: smooth; -webkit-overflow-scrolling: touch;"
       >
           @foreach($post->images as $index => $image)
               <div class="rounded-3xl flex-shrink-0 w-full h-[750px] snap-start">
                   <img
                       src="{{ asset('storage/' . $image->image_path) }}"
                       alt="Post image"
                       class="object-cover w-full h-full rounded-3xl shadow-md">
               </div>
           @endforeach
       </div>

       <!-- Navigation Dots -->
       <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20">
           <div class="flex space-x-2 transition-opacity duration-300 ease-out opacity-0 group-hover:opacity-100">
               @foreach($post->images as $index => $image)
                   <button
                       class="w-2.5 h-2.5 gap-2 rounded-full cursor-pointer transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)]"
                       :class="{
                           'bg-cyan-300 scale-110': activeSlide === {{ $index }},
                           'bg-gray-200 bg-opacity-40 scale-90': activeSlide !== {{ $index }}
                       }"
                       @click="
                           const slider = $refs.slider;
                           const scrollTo = slider.offsetWidth * {{ $index }};
                           slider.scrollTo({
                               left: scrollTo,
                               behavior: 'smooth'
                           });
                           activeSlide = {{ $index }};
                       "
                   ></button>
               @endforeach
           </div>
       </div>
   </div>
   @endif
    <!-- Blog Post Content -->
    <div class="prose max-w-none">
        {!! $post->content !!}
    </div>

    <!-- Published Date -->
    <div class="text-gray-500 text-sm mt-10 mb-3">
        Published on {{ $post->created_at->format('M d, Y') }}
    </div>

    <!-- Edit and Delete Buttons -->
    @if (Auth::check() && Auth::user()->id === $post->user_id)
        <div class="my-10">
            <a href="/blog/{{ $post->slug }}/edit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Edit
            </a>
            <form action="/blog/{{ $post->slug }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 ml-2">
                    Delete
                </button>
            </form>
        </div>
    @endif
</div>

{{-- Comments Section --}}
@if ($post)
<div class="w-10/12 m-auto pt-20 border-t border-gray-300">
    <div>
        <h2 class="mb-5 text-3xl font-bold">Comments</h2>

        @foreach ($post->comments as $comment)
            <div class="border-b border-gray-200 mb-4 pb-4">
                <strong>{{ $comment->user->name }}</strong>
                <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                <p class="mt-2">{{ $comment->content }}</p>
            </div>
        @endforeach

        {{-- Comments Form --}}
        @if(auth()->check())
        <div>
            <form action="{{ url('/posts/' . $post->id . '/comments') }}" method="POST" class="-m-1">
                @csrf
                <textarea
                    name="content"
                    rows="3"
                    class="w-full p-5 border border-gray-300 rounded-3xl focus:border-cyan-300 focus:ring-0 focus:outline-none transition-colors"
                    placeholder="Add a comment..."
                    required
                ></textarea>
               </form>

                <div class="mt-6 mb-10 flex flex-col items-end">
                    <button
                        type="submit"
                        class="px-6 py-2 bg-cyan-400 text-white rounded-full hover:bg-cyan-600 transition-colors duration-200"
                    >
                        Post Comment
                    </button>
                </div>
            </div>
        @else
        <div>
            <p class="mt-6 mb-20 ml-1 underline"><a href="{{ route('login') }}" class="text-cyan-400">Log in to comment</a></p>
        </div>
        @endif

    </div>
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
