@props(['review'])

@php
    // Memisahkan string gambar menjadi array
    $productImages = explode('|', $review['product_image']);
    $firstProductImage = $productImages[0] ?? 'https://via.placeholder.com/150?text=Product';
@endphp

<div class="card bg-white rounded-xl p-6 group relative overflow-hidden shadow-md transition-all duration-300 hover:shadow-lg">

    <!-- Product thumbnail -->
    <div class="absolute top-4 right-4 flex items-center gap-2">
        <div class="text-xs text-gray-600 dark:text-gray-400 text-right">
            Review for:<br>
            <span class="font-medium text-[#a08963] dark:text-[#a08963]">
                {{ $review['product_name'] }}
            </span>
        </div>
        <div class="w-12 h-12 rounded-md overflow-hidden border border-gray-300 dark:border-gray-600 bg-gray-200">
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
    <div class="flex items-center mb-4">
        <div class="relative w-12 h-12">
            <img 
                src="{{ $review['image'] }}" 
                alt="{{ $review['name'] }}" 
                class="w-full h-full rounded-full object-cover border-2 border-[#a08963] dark:border-[#a08963]"
                onerror="this.onerror=null;this.src='https://via.placeholder.com/150?text=User  '"
            />
        </div>
        <div class="ml-4">
            <h3 class="font-semibold text-gray-800 dark:text-gray-900 text-lg">
                {{ $review['name'] }}
            </h3>
            <span class="text-xs text-gray-500 dark:text-gray-400">
                Customer review
            </span>
        </div>
    </div>
    
    <!-- Rating and content -->
    <div class="mb-4">
        <div class="flex items-center mb-2">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $review['rating'])
                    <span class="text-yellow-500 text-lg">★</span> <!-- Bintang berwarna kuning -->
                @else
                    <span class="text-gray-400 text-lg">☆</span>
                @endif
            @endfor
            <span class="ml-2 text-sm font-medium text-[#a08963]">{{ $review['rating'] }}.0</span>
        </div>
        <p class="text-gray-700 dark:text-gray-600 text-sm leading-relaxed">
            {{ $review['content'] }}
        </p>
    </div>
</div>
