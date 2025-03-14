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

    <div class="comic-gallery grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-25 px-10 py-10">
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
        <div class="comic-container">
            <img class="comic-image" src="{{ asset('images/walking-dead-comic1.jpeg') }}" />
            <div class="comic-info">
                <h3 class="text-xl font-semibold">The Walking Dead</h3>
                <p class="text-gray-600 text-sm">The Walking Dead is an American post-apocalyptic comic book series created by writer Robert Kirkman and artist Tony Moore – who was the artist on the first six issues and cover artist for the first twenty-four – with art on the remainder of the series by Charlie Adlard. Beginning in 2003.....</p>
            </div>
            <div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">View Details</button>
            </div>
        </div>
        <div class="comic-container">
            <img class="comic-image" src="{{ asset('images/watchmen-comic1.jpeg') }}" />
            <div class="comic-info">
                <h3 class="text-xl font-semibold">Watchmen</h3>
                <p class="text-gray-600 text-sm">Watchmen is a comic book limited series by the British creative team of writer Alan Moore, artist Dave Gibbons, and colorist John Higgins. It was published monthly by DC Comics in 1986 and 1987 before being collected in a single-volume edition in 1987. Watchmen originated.....</p>
            </div>
            <div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">View Details</button>
            </div>
        </div>
        <div class="comic-container">
            <img class="comic-image" src="{{ asset('images/marvel-comic1.jpeg') }}" />
            <div class="comic-info">
                <h3 class="text-xl font-semibold">Marvel's Civil War</h3>
                <p class="text-gray-600 text-sm">"Civil War" is a 2006–07 Marvel Comics crossover event. The storyline consists of an eponymous seven-issue limited series, written by Mark Millar and penciled by Steve McNiven, and various tie-in books. The storyline builds upon.....</p>
            </div>
            <div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">View Details</button>
            </div>
        </div>
        <div class="comic-container">
            <img class="comic-image" src="{{ asset('images/tech-jacket-comic1.jpeg') }}" />
            <div class="comic-info">
                <h3 class="text-xl font-semibold">Tech Jacket</h3>
                <p class="text-gray-600 text-sm">Tech Jacket is an American comic book created by writer Robert Kirkman and artist E. J. Su, first published monthly by Image Comics for six issu.....</p>
            </div>
            <div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">View Details</button>
            </div>
        </div>
        <div class="comic-container">
            <img class="comic-image" src="{{ asset('images/dc-comic1.jpg') }}" />
            <div class="comic-info">
                <h3 class="text-xl font-semibold">Injustice</h3>
                <p class="text-gray-600 text-sm">Injustice: Gods Among Us is an American comic book series that serves as the prequel to the fighting video game of the same name. The series takes place in an alternate reality, where Superman descends into villainy following his famil.....</p>
            </div>
            <div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">View Details</button>
            </div>
        </div>
    </div>    
@endsection