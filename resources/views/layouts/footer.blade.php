<footer class="bg-blue-50 py-14">
    <div class="w-5/6 m-auto border-b-2 border-gray-700 pb-16 flex flex-col justify-center items-center">
        <div class="sm:grid grid-cols-3 gap-96">
        <div>
            <h3 class="text-l sm:font-bold text-black-100">
                Pages
            </h3>
            <ul class="py-4 sm:text-s pt-4 text-black-400">
                <li class="pb-1"><a href="/">Home</a></li>
                <li class="pb-1"><a href="/blog">Blog</a></li>
                <li class="pb-1"><a href="/login">Login</a></li>
                <li class="pb-1"><a href="/register">Register</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-l sm:font-bold text-black-100">
                Find Us
            </h3>
            <ul class="py-4 sm:text-s pt-4 text-black-400">
                <li class="pb-1"><a href="/">What we do</a></li>
                <li class="pb-1"><a href="/">Address</a></li>
                <li class="pb-1"><a href="/">Phone</a></li>
                <li class="pb-1"><a href="/">Contact</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-l sm:font-bold text-black-100">
                Latest posts
            </h3>
            <ul class="py-4 sm:text-s pt-4 text-black-400">
                @forelse ($latestPosts as $post)
                   <li class="pb-1 relative group">
                        <a href="{{ route('posts.show', $post->slug) }}"
                            class="hover:text-cyan-400 inline-block">
                            {{ Str::limit($post->title, 16, '...') }}
                            <span class="left-3 absolute z-10 invisible group-hover:visible bg-blue-200 text-gray-800 text-xs px-3 py-1.5 rounded-3xl top-full left-1/2 -translate-x-1/2 mt-2 whitespace-nowrap transition-opacity duration-200">
                                {{ $post->title }}
                                <svg class="absolute text-blue-200 h-1.5 w-full left-0 top-0 -translate-y-full" viewBox="0 0 10 5">
                                    <path d="M0 5L5 0 10 5" class="fill-current"/>
                                </svg>
                            </span>
                        </a>
                    </li>
                @empty
                    <li class="pb-1">No posts available.</li>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="py-2 mt-8 bg-blue-50 w-4/5 mx-auto text-center">
            <div class="max-w-4xl mx-auto px-4">
                <h2 class="text-3xl font-semibold text-black-400">Join the Jellycat Adventure</h2>
                <p class="mt-4 text-lg text-gray-600">
                    Stay updated on the latest collections, blog posts, and exclusive releases by subscribing to our newsletter.
                </p>
                <div class="mt-8 max-w-md mx-auto flex gap-4">
                    <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-2 rounded-full border border-gray-300 focus:border-cyan-300 focus:ring-0 focus:outline-none transition-colors">
                    <button class="bg-cyan-400 text-white px-6 py-2 rounded-full hover:bg-cyan-600 transition-colors duration-300">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </div>


    <p class="w-5/6 m-auto text-xs text-black-100 pt-0.5">
        © Jellycat Limited 2025. All Rights Reserved
    </p>
</footer>
