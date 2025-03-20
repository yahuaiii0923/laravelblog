@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="background-image grid grid-cols-1 m-auto bg-blue-100">
        <div class="flex text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-10 sm:m-auto w-4/5 block text-left">
                <h1 class="sm:text-white text-5xl uppercase font-bold text-shadow-md pb-14">
                    Welcome to the Jellycat World
                </h1>
                <a href="/blog" class="group relative inline-flex items-center text-white font-bold text-xl py-2 px-4 rounded-full hover:scale-105 transition-all duration-300">
                    <span>Explore Collections</span>
                    <span class="ml-2 relative h-6 w-8 overflow-hidden">
                        <svg class="absolute right-0 w-6 h-6 text-teal-400 transition-all duration-300 group-hover:translate-x-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                        <span class="absolute left-0 top-1/2 w-0 h-[2px] bg-teal-400 transition-all duration-300 group-hover:w-full -translate-y-1/2"></span>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Collections -->
    <div class="max-w-6xl mx-auto py-12 px-4">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Featured Collections</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://cdn11.bigcommerce.com/s-fz2bnmwg7y/images/stencil/original/image-manager/amuseables-storm-cloud-bag-pink-orchid-flower-shop-card-carousel.jpg?t=1741701802" alt="Amuseables" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-softblue mb-2">Amuseables</h3>
                    <p class="text-gray-600">Whimsical characters that bring everyday objects to life</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="https://cdn11.bigcommerce.com/s-fz2bnmwg7y/images/stencil/1920w/image-manager/blossom-bunnies-shopping-desktop.jpg?t=1736871459" alt="Bashful Collection" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-softblue mb-2">Bashful Bunnies</h3>
                                <p class="text-gray-600">Our iconic collection of soft, floppy-eared companions</p>
                            </div>
                        </div>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://cdn11.bigcommerce.com/s-fz2bnmwg7y/images/stencil/original/image-manager/mooliet-cow-cafe-ss25-card-carousel.jpg?t=1741701838" alt="25 Anniversary" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-softblue mb-2">Fuddlewuddle Friends</h3>
                    <p class="text-gray-600">A delightfully textured collection of cuddly friends with the softest, rippled fur.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Blog Posts Section -->
    <div id="latest-blog-posts" class="max-w-screen-2xl mx-auto py-12 px-16 bg-gray-50">
        <h2 class="text-3xl font-semibold text-coral text-center mb-6">Latest Blog Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($posts as $post)
            <a href="{{ route('posts.show', $post->slug) }}" class="block bg-white shadow-md rounded-3xl hover:shadow-lg transition-shadow duration-300 group">
                <div class="h-48 w-full overflow-hidden rounded-t-3xl">
                    <img src="{{ asset('images/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-softblue group-hover:text-teal-600 transition-colors">
                        {{ $post->title }}
                    </h3>
                    <p class="text-gray-600 mt-2">{{ Str::limit($post->excerpt, 120) }}</p>
                    <div class="mt-4 inline-block text-mint underline group-hover:text-teal-600 transition-colors">
                        Read More
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-16 mt-12">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl font-semibold text-teal-400">Join the Jellycat Adventure</h2>
            <p class="mt-4 text-lg text-gray-600">Stay updated on the latest collections, blog posts, and exclusive releases by subscribing to our newsletter.</p>
            <div class="mt-8 max-w-md mx-auto flex gap-4">
                <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-400">
                <button class="bg-teal-400 text-white px-6 py-2 rounded-lg hover:bg-teal-600 transition-colors duration-300">
                    Subscribe
                </button>
            </div>
        </div>
    </div>
@endsection
