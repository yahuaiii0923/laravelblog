@extends('layouts.app')

@section('content')
    <div class="background-image grid grid-cols-1 m-auto bg-blue-100">
        <div class="flex text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-white text-5xl uppercase font-bold text-shadow-md pb-14">
                    Welcome to the Jellycat Stories!
                </h1>
                <a
                    href="/blog"
                    class="text-center text-white-700 py-2 px-4 font-bold text-xl rounded-full">
                    Enjoy the Stories
                </a>
            </div>
        </div>
    </div>

    <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
        <div>
            <img src="https://www.jellycat.com/media/wysiwyg/jellycat-products.jpg" width="700" alt="Jellycat Collection">
        </div>

        <div class="m-auto sm:m-auto text-left w-4/5 block">
            <h2 class="text-3xl font-extrabold text-gray-600">
                Discover the Magic of Jellycat Toys!
            </h2>

            <p class="py-8 text-gray-500 text-s">
                Our Jellycat collection is perfect for every age, featuring soft, cuddly, and adorable plush toys. Explore our wide range today!
            </p>

            <p class="font-extrabold text-gray-600 text-s pb-9">
                From bunnies to bears, each Jellycat creation tells its own story of joy and comfort. Whether you're buying for yourself or a loved one, there's a toy to bring smiles and comfort.
            </p>

            <a
                href="/blog"
                class="uppercase bg-blue-500 text-gray-100 text-s font-extrabold py-3 px-8 rounded-3xl">
                Learn More
            </a>
        </div>
    </div>

    <div class="text-center p-15 bg-blue-800 text-white">
        <h2 class="text-2xl pb-5 text-l">
            Our Expertise
        </h2>

        <span class="font-extrabold block text-4xl py-1">
            Plush Toy Design
        </span>
        <span class="font-extrabold block text-4xl py-1">
            Toy Safety Standards
        </span>
        <span class="font-extrabold block text-4xl py-1">
            Custom Plush Creations
        </span>
        <span class="font-extrabold block text-4xl py-1">
            Global Toy Distribution
        </span>
    </div>

    <div class="text-center py-15">
        <span class="uppercase text-s text-gray-400">
            Blog
        </span>

        <h2 class="text-4xl font-bold py-10">
            Latest Jellycat Adventures
        </h2>

        <p class="m-auto w-4/5 text-gray-500">
            Dive into the world of Jellycat through our blog, featuring the latest collections, fun facts, and heartwarming stories from our plush family.
        </p>
    </div>

    <div class="sm:grid grid-cols-2 w-4/5 m-auto">
        <div class="flex bg-blue-700 text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block">
                <span class="uppercase text-xs">
                    New Arrival
                </span>

                <h3 class="text-xl font-bold py-10">
                    Meet the new Jellycat friends! From cuddly companions to adorable characters, these new plush toys are ready to steal your heart.
                </h3>

                <a
                    href="/blog"
                    class="uppercase bg-transparent border-2 border-gray-100 text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
                    Discover Now
                </a>
            </div>
        </div>
        <div>
            <img src="https://www.jellycat.com/media/wysiwyg/new-jellycat-toy.jpg" alt="New Jellycat Toy">
        </div>
    </div>
@endsection
