@extends('layouts.app')

@section('content')
<div class="bg-blue-50">
    <!-- Hero Section -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Safety & Care</h1>
            <p class="text-base text-gray-600 max-w-3xl mx-auto">Your Jellycat friends deserve the best care.</br>
            Follow these guidelines to keep them safe and looking lovely for years to come.</p>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Grid Sections -->
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Safety Standards Column -->
            <div class="space-y-8">
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Safety Standards</h2>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900">Age Recommendations</h3>
                            <p class="text-gray-600">All Jellycat toys are suitable from birth and meet these strict safety standards:</p>
                            <ul class="list-disc pl-5 space-y-2 text-gray-600">
                                <li>EN71 (European Safety Standard)</li>
                                <li>ASTM F963 (US Safety Standard)</li>
                                <li>CCPSA (Canadian Safety Standard)</li>
                            </ul>
                        </div>

                        <div class="space-y-4 pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Quality Assurance</h3>
                            <p class="text-gray-600">Every toy undergoes rigorous testing for:</p>
                            <ul class="list-disc pl-5 space-y-2 text-gray-600">
                                <li>Fabric safety and non-toxicity</li>
                                <li>Stitch durability testing</li>
                                <li>Secure attachment of all components</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Care Instructions Column -->
            <div class="space-y-8">
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Care Instructions</h2>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900">Cleaning Guide</h3>
                            <ul class="list-disc pl-5 space-y-2 text-gray-600">
                                <li>Surface clean with damp cloth</li>
                                <li>Hand wash in cold water (max 30°C)</li>
                                <li>Use mild detergent</li>
                                <li>Air dry naturally - never tumble dry</li>
                                <li>Do not iron or dry clean</li>
                            </ul>
                        </div>

                        <div class="space-y-4 pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Storage Tips</h3>
                            <ul class="list-disc pl-5 space-y-2 text-gray-600">
                                <li>Store in cool, dry place</li>
                                <li>Avoid direct sunlight</li>
                                <li>Use acid-free tissue for collectibles</li>
                                <li>Refresh periodically with gentle brushing</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Section -->
        <div class="my-16">
            <div class="rounded-2xl overflow-hidden shadow-xl">
                <img src="https://cdn11.bigcommerce.com/s-fz2bnmwg7y/images/stencil/original/image-manager/backpack-dino-bunny-bath-2000-900.jpg?t=1711389393"
                     alt="Jellycat plush care example"
                     class="w-full h-96 object-cover transition-transform duration-300 hover:scale-105">
            </div>
        </div>

        <!-- Safety Notice & Repairs Section -->
        <div class="grid md:grid-cols-2 gap-12">
            <div class="object-center mt-10">
            <!-- Important Safety Notice -->
            <div class="bg-red-50 rounded-3xl border border-red-200">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 mt-1 pt-5 pl-5">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-red-700 mb-2 pt-5">Important Safety Notice</h3>
                        <p class="text-red-600 text-sm pb-6 pr-4">Always inspect toys regularly for loose threads or parts. Not suitable for children who still mouth objects. Remove all packaging before giving to a child.</p>
                    </div>
                </div>
            </div>
            </div>

            <!-- Repairs & Maintenance -->
            <div class="bg-blue-50 p-8 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Repairs & Maintenance</h3>
                <p class="text-gray-600 text-sm">While we don't offer repair services, we recommend:</p>
                <ul class="list-disc pl-5 space-y-2 text-gray-600 text-sm mt-2">
                    <li>Trim loose threads with small scissors</li>
                    <li>Use fabric glue for minor repairs</li>
                    <li>Brush matted fur gently with a soft brush</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Full-width White CTA Section -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Still have questions?</h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Our customer care team is happy to help with any safety or care concerns.</p>
                <a href="{{ route('contact') }}" class="bg-cyan-400 text-white px-8 py-3 rounded-full hover:bg-cyan-600 transition-colors duration-300 font-semibold">
                    Contact Customer Care
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
