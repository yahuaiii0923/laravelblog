@extends('layouts.app')

@section('content')
    <!-- Gifting Options Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-12 bg-white">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 tracking-wide mb-4">Gifting Options</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
            <!-- Drawstring Bags Column -->
            <div class="space-y-6">
                <div class="mb-8">
                    <h3 class="text-lg font-normal text-gray-900 mb-4">Drawstring Dust Bag</h3>
                    <div class="prose max-w-none text-gray-600">
                        <p class="mb-4">Our products come packed in a protective drawstring bag.</p>
                        <ul class="text-base list-disc pl-5 space-y-2">
                            <li>All items in an order packed in one bag</li>
                            <li>Option to pack items separately at checkout</li>
                            <li>Reusable protective packaging</li>
                        </ul>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center items-center gap-20">
                    <img src="https://cdn11.bigcommerce.com/s-fz2bnmwg7y/images/stencil/original/image-manager/gift-bag-group-1.jpg?t=1711391300"
                         alt="Multiple drawstring bags"
                         class="w-56 h-auto object-cover rounded-sm">
                    <img src="https://cdn11.bigcommerce.com/s-fz2bnmwg7y/images/stencil/original/image-manager/gift-bag-empty-group-3.jpg?t=1711391340"
                         alt="Empty drawstring bags"
                         class="w-56 h-auto object-cover rounded-sm">
                </div>
            </div>

            <!-- Gift Cards Column -->
            <div class="space-y-6">
                <div class="mb-8">
                    <h2 class="text-lg font-normal text-gray-900 mb-4">Gift Card & Message</h2>
                    <div class="prose max-w-none text-gray-600">
                        <p class="mb-4">Add a free gift message to your order at checkout.</p>
                        <ul class="text-base list-disc pl-5 space-y-2">
                            <li>Personalized message printed on Jellycat card</li>
                            <li>Maximum 200 characters</li>
                            <li>One card per order</li>
                        </ul>
                    </div>
                </div>

                <div class="flex justify-center items-center">
                    <img src="https://cdn11.bigcommerce.com/s-fz2bnmwg7y/images/stencil/original/image-manager/gift-card-1000-1000.jpg?t=1711390758"
                         alt="Gift card example"
                         class="w-full max-w-[480px] h-auto object-cover rounded-sm">
                </div>
            </div>
        </div>

        <!-- Contact Section -->

        <div class="text-center mt-12 p-6">
            <p class="text-gray-600 mb-6">If you have any questions in relation to placing orders with Gift Messages, please get in touch with the Jellycat Customer Care team</p>
            <a href="{{ route('contact') }}"
               class="inline-block bg-cyan-400 text-white px-8 py-2 rounded-full
                      hover:bg-cyan-800 transition-colors duration-200 text-lg
                      font-normal tracking-wide">
                Contact Us
            </a>
        </div>
    </div>
@endsection
