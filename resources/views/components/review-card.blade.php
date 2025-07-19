@props(['review'])

@php
    // Memisahkan string gambar menjadi array
    $productImages = explode('|', $review['product_image']);
    $firstProductImage = $productImages[0] ?? 'https://via.placeholder.com/150?text=Product';
    
    // Menentukan batas karakter untuk "read more"
    $maxLength = 100;
    $content = $review['content'];
    $isLongText = strlen($content) > $maxLength;
    $shortContent = $isLongText ? substr($content, 0, $maxLength) . '...' : $content;
    $uniqueId = 'review-' . uniqid();
@endphp

<div class="card bg-white rounded-xl p-5 group relative overflow-hidden shadow-md transition-all duration-300 hover:shadow-lg h-full min-h-[280px] flex flex-col">

    <!-- Product thumbnail -->
    <div class="absolute top-3 right-3 flex items-center gap-2">
        <div class="text-xs text-gray-600 dark:text-gray-400 text-right">
            Ulasan untuk:<br>
            <span class="font-medium text-[#a08963] dark:text-[#a08963]">
                {{ $review['product_name'] }}
            </span>
        </div>
        <div class="w-10 h-10 rounded-md overflow-hidden border border-gray-300 dark:border-gray-600 bg-gray-200">
            <img 
                src="{{ $firstProductImage }}" 
                alt="{{ $review['product_name'] }}" 
                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                loading="lazy"
                onerror="this.onerror=null;this.src='https://via.placeholder.com/150?text=Product'"
            />
        </div>
    </div>
    
    <!-- User info -->
   <div class="flex items-center mb-3">
    <div class="relative w-10 h-10">
        @if(!empty($review['image']))
            <img 
                src="{{ $review['image'] }}" 
                alt="{{ $review['name'] }}" 
                class="w-full h-full rounded-full object-cover border-2 border-[#a08963] dark:border-[#a08963]"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
            />
            <div class="absolute inset-0 w-full h-full rounded-full bg-[#a08963] dark:bg-[#a08963] items-center justify-center text-white font-semibold text-sm border-2 border-[#a08963] dark:border-[#a08963]" style="display: none;">
                {{ strtoupper(substr($review['name'], 0, 1)) }}
            </div>
        @else
            <div class="w-full h-full rounded-full bg-[#a08963] dark:bg-[#a08963] flex items-center justify-center text-white font-semibold text-sm border-2 border-[#a08963] dark:border-[#a08963]">
                {{ strtoupper(substr($review['name'], 0, 1)) }}
            </div>
        @endif
    </div>
    <div class="ml-3">
        <h3 class="font-semibold text-gray-800 dark:text-gray-900 text-base">
            {{ $review['name'] }}
        </h3>
        <span class="text-xs text-gray-500 dark:text-gray-400">
            Pelanggan
        </span>
    </div>
</div>
    
    <!-- Rating and content -->
    <div class="flex-1 flex flex-col">
        <div class="flex items-center mb-2">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $review['rating'])
                    <span class="text-yellow-500 text-base">★</span>
                @else
                    <span class="text-gray-400 text-base">☆</span>
                @endif
            @endfor
            <span class="ml-2 text-sm font-medium text-[#a08963]">{{ $review['rating'] }}.0</span>
        </div>
        
        <!-- Review content with read more functionality -->
        <div class="text-gray-700 dark:text-gray-600 text-sm leading-relaxed flex-1">
            @if ($isLongText)
                <div id="content-wrapper-{{ $uniqueId }}" class="h-full flex flex-col">
                    <div id="text-content-{{ $uniqueId }}" class="flex-1 overflow-hidden">
                        <div id="short-{{ $uniqueId }}" class="transition-opacity duration-300">{{ $shortContent }}</div>
                        <div id="full-{{ $uniqueId }}" class="hidden transition-opacity duration-300">{{ $content }}</div>
                    </div>
                    <button 
                        type="button"
                        onclick="toggleReadMore('{{ $uniqueId }}')"
                        id="btn-{{ $uniqueId }}"
                        class="text-[#a08963] hover:text-[#8a7555] font-medium transition-colors duration-200 focus:outline-none text-left mt-2 self-start"
                    >
                        Baca lebih banyak
                    </button>
                </div>
            @else
                <div class="flex-1">{{ $content }}</div>
            @endif
        </div>
    </div>
</div>

@if ($isLongText)
    @push('scripts')
        <script>
            function toggleReadMore(uniqueId) {
                const shortText = document.getElementById('short-' + uniqueId);
                const fullText = document.getElementById('full-' + uniqueId);
                const button = document.getElementById('btn-' + uniqueId);
                
                if (fullText.classList.contains('hidden')) {
                    // Show full text
                    shortText.classList.add('hidden');
                    fullText.classList.remove('hidden');
                    button.textContent = 'Baca lebih banyak';
                } else {
                    // Show short text
                    fullText.classList.add('hidden');
                    shortText.classList.remove('hidden');
                    button.textContent = 'Baca lebih sedikit';
                }
            }
        </script>
    @endpush
@endif