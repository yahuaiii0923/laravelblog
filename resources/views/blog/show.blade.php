@extends('layouts.app')

@section('content')
{{-- Back Button --}}
<div class="w-10/12 m-auto mt-8">
    <a href="{{ url('/blog') }}" class="text-cyan-600 hover:text-cyan-800 flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
    </a>
</div>

<div class="w-10/12 m-auto mt-8 text-center">
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
</div>

{{-- Comments Section --}}
@if($post)
<div class="w-10/12 m-auto pt-20 border-t border-gray-300" id="comments">

    <h2 class="mb-5 text-3xl font-bold">Comments</h2>

    @foreach ($post->comments as $comment)
        <div class="border-b border-gray-200 mb-4 pb-4 relative">
            <div class="flex items-center justify-between">
                <div>
                    <strong>{{ $comment->user->name }}</strong>
                    <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                </div>

                <div class="flex items-center space-x-2">
                    {{-- Like Button --}}
                    <form method="POST" action="{{ route('comments.like', $comment->id) }}">
                        @csrf
                        <button type="submit" class="flex items-center text-red-500 hover:text-red-600">
                            <svg class="w-5 h-5 {{ $comment->isLikedBy(auth()->user()) ? 'fill-red-500' : '' }}"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <span class="ml-1 text-sm">{{ $comment->likes_count }}</span>
                        </button>
                    </form>

                    {{-- Delete Button --}}
                    @auth
                    @if(auth()->user()->id === $comment->user_id)
                    <form method="POST"
                          action="{{ route('comments.destroy', $comment->id) }}"
                          onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-700 flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                    @endif
                    @endauth
                </div>
            </div>

            <p class="mt-2">{{ $comment->content }}</p>
        </div>
    @endforeach

    {{-- Comment Form --}}
    @auth
    <div class="mt-8">
        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="-m-1">
            @csrf
            <textarea
                name="content"
                rows="3"
                class="w-full p-5 border border-gray-300 rounded-3xl focus:border-cyan-300 focus:ring-0 focus:outline-none transition-colors"
                placeholder="Add a comment..."
                required
            ></textarea>
            <div class="mt-6 mb-10 flex flex-col items-end">
                <button
                    type="submit"
                    class="px-6 py-2 bg-cyan-400 text-white rounded-full hover:bg-cyan-600 transition-colors duration-200"
                >
                    Post Comment
                </button>
            </div>
        </form>
    </div>
    @else
    <div class="mt-8">
        <p class="mt-6 mb-20 ml-1 underline">
            <a href="{{ route('login') }}" class="text-cyan-400">Log in to comment</a>
        </p>
    </div>
    @endauth
</div>
@else
<div class="w-4/5 m-auto text-center py-20">
    <h2 class="text-4xl text-red-500">Post Not Found</h2>
    <p class="text-gray-500 mt-3">The post you are looking for does not exist.</p>
    <a href="{{ url('/blog') }}" class="text-blue-500 mt-5 inline-block">Go back to blog</a>
</div>
@endif

@endsection


