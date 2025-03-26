@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white via-blue-50 to-white py-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-cyan-600 mb-4">🧸 Plushie Matchmaker</h1>
            <p class="text-xl text-gray-600">Discover your perfect Jellycat companion through magical traits!</p>

            <!-- Progress Bar -->
            <div class="mt-6 max-w-md mx-auto">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-cyan-600" id="progressText">0/3 traits selected</span>
                    <span class="text-sm font-medium text-cyan-600" id="progressPercent">0%</span>
                </div>
                <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                    <div id="progressBar" class="h-full bg-cyan-600 transition-all duration-500 ease-out" style="width: 0%"></div>
                </div>
            </div>
        </div>

        <!-- Preview Area -->
        <div id="plushiePreview" class="mb-12 bg-white rounded-2xl p-6 shadow-xl">
            <div class="grid md:grid-cols-2 gap-8 min-h-96">
                <div class="relative">
                    <img src="{{ asset('storage/images/bashfulbunny.jpg') }}" alt="Preview"
                         class="w-full h-96 object-contain rounded-xl transition-opacity duration-300"
                         id="previewImage">
                    <div class="absolute inset-0 flex items-center justify-center" id="loadingSpinner" style="display: none;">
                        <svg class="animate-spin h-12 w-12 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-4">
                    <h3 class="text-3xl font-bold text-gray-800" id="previewName">Your Perfect Match</h3>
                    <p class="text-lg text-gray-600" id="previewText">
                        Select traits to see your ideal plushie companion come to life!
                    </p>
                </div>
            </div>
        </div>

        <!-- Trait Selectors -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="traitSelector">
            @foreach(['personality', 'color', 'features'] as $category)
            <div class="bg-white rounded-2xl p-6 shadow-xl">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    @switch($category)
                        @case('personality') Personality Traits @break
                        @case('color') Color Preferences @break
                        @case('features') Special Features @break
                    @endswitch
                </h2>
                <div class="grid grid-cols-1 gap-4">
                    @foreach($traits[$category] as $trait)
                    <button type="button"
                            data-category="{{ $category }}"
                            data-value="{{ Str::slug($trait) }}"
                            class="trait-btn py-3 px-6 rounded-full border-2 border-cyan-200 text-gray-700 hover:bg-cyan-50 transition-all text-left">
                        {{ $trait }}
                    </button>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const elements = {
        previewImage: document.getElementById('previewImage'),
        previewName: document.getElementById('previewName'),
        previewText: document.getElementById('previewText'),
        loadingSpinner: document.getElementById('loadingSpinner'),
        progressBar: document.getElementById('progressBar'),
        progressText: document.getElementById('progressText'),
        progressPercent: document.getElementById('progressPercent')
    };

    let currentSelections = {
        personality: null,
        color: null,
        features: null
    };

    function updateProgress() {
        const selected = Object.values(currentSelections).filter(v => v !== null).length;
        const percent = Math.round((selected / 3) * 100);
        elements.progressBar.style.width = `${percent}%`;
        elements.progressText.textContent = `${selected}/3 traits selected`;
        elements.progressPercent.textContent = `${percent}%`;
        return selected;
    }

    function createSeed(selections) {
        return Object.values(selections).filter(v => v).join('|');
    }

    document.querySelectorAll('.trait-btn').forEach(button => {
        button.addEventListener('click', async function() {
            const category = this.dataset.category;
            const value = this.dataset.value;
            const isSelected = this.classList.contains('bg-cyan-200');

            // Clear all selections in category
            document.querySelectorAll(`[data-category="${category}"]`).forEach(btn => {
                btn.classList.remove('bg-cyan-200', 'border-cyan-400');
            });

            // Toggle selection
            if (!isSelected) {
                this.classList.add('bg-cyan-200', 'border-cyan-400');
                currentSelections[category] = value;
            } else {
                currentSelections[category] = null;
            }

            const selectedCount = updateProgress();

            if (selectedCount > 0) {
                elements.loadingSpinner.style.display = 'flex';
                elements.previewImage.style.opacity = '0.5';

                try {
                    const response = await fetch('/matchmaker/process', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            ...currentSelections,
                            seed: createSeed(currentSelections)
                        })
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();

                    if (data.error) {
                        throw new Error(data.error);
                    }

                    elements.previewImage.src = data.image_url + `?t=${Date.now()}`;
                    elements.previewName.textContent = data.name;
                    elements.previewText.textContent = data.story;

                } catch (error) {
                    console.error('Fetch error:', error);
                    elements.previewText.textContent = error.message;
                    elements.previewImage.src = "{{ asset('storage/images/default-plushie.jpg') }}";
                } finally {
                    elements.loadingSpinner.style.display = 'none';
                    elements.previewImage.style.opacity = '1';
                }
            }
        });
    });
});
</script>
@endsection
