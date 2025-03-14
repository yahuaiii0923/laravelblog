@extends('layouts.app')

@section('content')
    <div class="background-image grid grid-cols-1 m-auto">
        <div class="flex text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-white text-5xl uppercase font-bold text-shadow-md pb-14">
                    The World of Comics!
                </h1>
            </div>
        </div>
    </div>

    <div class="text-center py-15">
        <h2 class="text-4xl font-bold py-10">
            Recommended Reading
        </h2>

        <p class="m-auto w-4/5 text-gray-500">
            Below are a few comics that I think you will enjoy a lot! Be sure to leave comments in each comic to give your own opinion of them!
        </p>
    </div>

    <div class="comic-gallery grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-10 py-10">
        <div class="comic-container">
            <img class="comic-image" src="{{ asset('images/invincible-comic2.jpeg') }}" />
            <div class="comic-info">
                <h3 class="text-xl font-semibold">Invincible</h3>
                <p class="text-gray-600 text-sm">Invincible is an American comic book series written by Robert Kirkman, illustrated by Cory Walker and Ryan Ottley, and published by Image Comics. Set in the Image Universe.....</p>
            </div>
            <div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">View Details</button>
            </div>
        </div>
    </div>    
@endsection