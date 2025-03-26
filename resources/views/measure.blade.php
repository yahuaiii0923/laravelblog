@extends('layouts.app')

@section('content')
<!-- Title Section -->
<div class="bg-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900">How We Measure</h1>
    </div>
</div>

<!-- Content Section -->
<div class="bg-blue-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-[40%_60%] gap-8 items-center">
            <div class="space-y-6 max-w-prose">
                <div class="prose-lg text-gray-700">
                    <p class="text-xl">A Jellycat can come in all shapes and sizes; round or long, little or big, sitting up or lying down.</p>
                    <p class="text-xl mt-6">To help you make the best decision about what size your chosen Jellycat is, here is some information to help you!</p>
                    <p class="text-xl mt-6">On each individual product page you will find dimensions which will provide you with the height, width and length of a product, always in that order.</p>
                </div>

                <!-- Important Notice Box -->
                <div class="bg-red-50 p-6 rounded-3xl border border-red-500 -ml-1">
                    <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                       <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                       </svg>
                    </div>
                    <div>
                        <h2 class="text-red-600 text-sm mt-0.5">Ears and tails will never be included in any measurements.</h2>
                    </div>
                </div>
                </div>
            </div>

            <!-- Bear Image -->
            <div class="relative h-[400px] rounded-2xl overflow-hidden shadow-2xl -mr-8">
                <img src="https://cdn11.bigcommerce.com/s-8zeylxlay7/images/stencil/original/image-manager/size-guide-bears-1500-780-web.jpg?t=1709740694"
                     alt="Jellycat size comparison"
                     class="w-full h-full object-cover object-left bg-white">
            </div>
        </div>
    </div>
</div>

<!-- Measurement Guide Section - Gray Background -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Measurement Diagram -->
            <div class="bg-blue-50 p-8 rounded-3xl shadow-xl">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Detailed Measurement Guide</h2>
                <div class="relative h-[650px] mt-10 bg-white rounded-3xl overflow-hidden flex items-center justify-center">
                    <img src="https://cdn11.bigcommerce.com/s-fz2bnmwg7y/images/stencil/original/image-manager/size-guide-new-1.jpg?t=1710959741"
                         alt="Measurement diagram"
                         class="w-[900px] h-auto object-contain">
                    <div class="absolute inset-0 flex flex-col justify-between p-6 bg-black bg-opacity-0 rounded-3xl">
                        <div class="text-center pt-4">
                            <span class="bg-blue-50 text-cyan-400 px-4 py-2 rounded-full text-sm font-bold shadow-lg">HEIGHT</span>
                            <p class="mt-6 text-gray-800 text-shadow">From base to highest point</p>
                        </div>
                        <div class="text-center pb-4">
                            <span class="bg-blue-50 text-cyan-400 px-4 py-2 rounded-full text-sm font-bold shadow-lg">WIDTH</span>
                            <p class="mt-6 text-gray-900 text-shadow">Widest point across</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Size Categories & Tips -->
            <div class="space-y-8">
                <!-- Measuring Tips -->
                <div class="bg-blue-50 p-6 rounded-2xl shadow-xl">
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">Measuring Tips</h3>
                        <div class="items-start">
                            <img src="https://cdn11.bigcommerce.com/s-fz2bnmwg7y/images/stencil/original/image-manager/size-guide-new-3.jpg?t=1710959761"
                                 alt="Measuring instructions"
                                 class="rounded-xl shadow-sm w-full h-48 object-cover">
                                 <ul class="list-disc pl-5 space-y-1 text-gray-600 text-lg mt-4">
                                    <li>Measure while toy is sitting naturally</li>
                                    <li>Use flexible measuring tape</li>
                                    <li>All measurements are approximate</li>
                                    <li>Contact us for specific dimensions</li>
                                 </ul>
                             </div>
                         </div>
                <!-- Size Categories -->
                <div class="bg-blue-50 p-6 rounded-2xl shadow-xl">
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">Size Categories</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 border divide-gray-400 bg-white rounded-3xl">
                            <span class="text-xs text-gray-700">Small</span>
                            <span class="text-gray-600 text-xs">up to 15cm</span>
                        </div>
                        <div class="flex items-center justify-between p-3 border divide-gray-400 bg-white rounded-3xl">
                            <span class="text-sm text-gray-700">Medium</span>
                            <span class="text-gray-600 text-sm">16-30cm</span>
                        </div>
                        <div class="flex items-center justify-between p-3 border divide-gray-400 bg-white rounded-3xl">
                            <span class="text-base text-gray-700">Large</span>
                            <span class="text-gray-600 text-base">31-50cm</span>
                        </div>
                        <div class="flex items-center justify-between p-3 border divide-gray-400 bg-white rounded-3xl">
                            <span class="text-lg text-gray-700">Huge</span>
                            <span class="text-gray-600 text-lg">51cm+</span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
