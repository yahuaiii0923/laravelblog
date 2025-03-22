@extends('layouts.app')

@section('content')
    <!-- Contact Hero Section -->
    <div class="contact-hero-background grid grid-cols-1 m-auto bg-blue-100">
        <div class="flex text-gray-100 pt-20 pb-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-white text-5xl font-bold tracking-wide text-shadow-md pb-4">
                    Get in Touch with Jellycat World
                </h1>
            </div>
        </div>
    </div>

    <!-- Contact Content -->
    <div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-3xl font-semibold text-gray-800 ">Send Us a Message</h2>
                <p class="text-sm text-gray-800 font-light mb-6">
                    We'd love to hear your jellycat stories or answer any questions!
                </p>

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-3xl">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-3xl">
                            {{ session('success') }}
                        </div>
                    @endif
                    @csrf

                    <div>
                        <label for="name" class="block text-gray-700 text-sm font-semibold ml-1 mb-2">Your Name</label>
                        <input type="text" id="name" name="name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-3xl focus:ring-2 focus:ring-cyan-400 focus:border-transparent"
                               required>
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-semibold ml-1 mb-2">Email Address</label>
                        <input type="email" id="email" name="email"
                               class="w-full px-4 py-3 border border-gray-300 rounded-3xl focus:ring-2 focus:ring-cyan-400 focus:border-transparent"
                               required>
                    </div>

                    <div>
                        <label for="message" class="block text-gray-700 text-sm font-semibold ml-2 mb-2">Your Message</label>
                        <textarea id="message" name="message" rows="5"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-3xl focus:ring-2 focus:ring-cyan-400 focus:border-transparent"
                                  required></textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-cyan-400 text-white font-bold py-3 px-6 rounded-3xl hover:bg-cyan-500 transition-colors duration-300">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="space-y-8">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Contact Information</h2>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-cyan-400 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-2">Visit Us</h3>
                                <p class="text-gray-600">123 Jellycat Lane<br>Plush City, PC 12345<br>United Kingdom</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-cyan-400 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-2">Call Us</h3>
                                <p class="text-gray-600">+44 1234 567890<br>Mon-Fri: 9am - 5pm GMT</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-cyan-400 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-2">Email Us</h3>
                                <p class="text-gray-600">hello@jellycatworld.com<br>stories@jellycatworld.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Embed -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158858.1824097244!2d-0.10159865000000001!3d51.52864165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C%20UK!5e0!3m2!1sen!2sus!4v1718373956941!5m2!1sen!2sus"
                            width="100%"
                            height="300"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="rounded-2xl">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
