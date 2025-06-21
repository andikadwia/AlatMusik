@props(['product'])

<a href="{{ route('products.show', $product->id) }}" class="group relative block overflow-hidden rounded-lg bg-white shadow-sm transition-all duration-200 hover:shadow-md border border-gray-100 hover:border-primary/50">
    <!-- Badges with subtle hover animation -->
    <div class="absolute top-3 left-3 z-10 flex gap-2">
        @if($product->is_premium ?? false)
        <span class="bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-1 rounded-full flex items-center border border-amber-200 transition-transform duration-200 group-hover:scale-[1.03]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd" />
            </svg>
            Premium
        </span>
        @endif

        @if($product->discount > 0)
        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1 rounded-full border border-red-200 transition-transform duration-200 group-hover:scale-[1.03]">
            Sale -{{ $product->discount }}%
        </span>
        @endif
    </div>

    <!-- Product Image with smooth zoom -->
    <div class="relative h-64 overflow-hidden bg-gray-50">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" 
             class="h-full w-full object-cover transition-transform duration-500 ease-out group-hover:scale-110" />
        
        <!-- Quick Actions - Fade in on hover -->
        <div class="absolute inset-0 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/5">
            <button class="rounded-full bg-white p-2 text-gray-700 hover:bg-gray-50 shadow-sm transition-transform duration-200 hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Product Details -->
    <div class="p-4">
        <!-- Category with subtle slide -->
        <p class="text-xs font-medium text-gray-500 mb-1 transition-transform duration-200 group-hover:translate-x-[2px]">
            {{ $product->category }}
        </p>
        
        <!-- Product Name with color transition -->
        <h3 class="font-semibold text-gray-900 group-hover:text-primary transition-colors duration-200 line-clamp-2 mb-2">
            {{ $product->name }}
        </h3>
        
        <!-- Rating with star hover effects -->
        <div class="flex items-center mb-3">
            <div class="flex items-center mr-1">
                @php
                    $rating = $product->rating ?? 0;
                    $fullStars = floor($rating);
                @endphp
                
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $fullStars)
                        <svg class="w-4 h-4 text-amber-400 hover:text-amber-500 transition-colors duration-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @else
                        <svg class="w-4 h-4 text-gray-300 hover:text-gray-400 transition-colors duration-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endif
                @endfor
            </div>
            <span class="text-xs text-gray-500 transition-transform duration-200 group-hover:translate-x-[2px]">
                {{ number_format($rating, 1) }}
                @if(isset($product->review_count))
                <span class="text-gray-400">({{ $product->review_count }})</span>
                @endif
            </span>
        </div>

        <!-- Price & Stock with subtle hover effect -->
        <div class="flex items-center justify-between border-t border-gray-100 pt-3 group-hover:[&>*]:translate-x-[2px] [&>*]:transition-transform [&>*]:duration-200">
            <div>
                @if($product->discount > 0)
                <span class="text-xs line-through text-gray-400 mr-2">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
                @endif
                <span class="font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            </div>
            
            @php
                $stock = $product->stock ?? 0;
                $stock = is_numeric($stock) ? (int)$stock : 0;
            @endphp

            @if($stock > 0)
                <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded transition-colors duration-200 group-hover:bg-green-100">
                    Tersedia
                </span>
            @else
                <span class="text-xs font-medium text-red-600 bg-red-50 px-2 py-1 rounded transition-colors duration-200 group-hover:bg-red-100">
                    Tidak tersedia
                </span>
            @endif
        </div>

        <!-- Add to Cart Button with subtle pulse -->
        <button class="mt-3 w-full bg-primary hover:bg-primary-dark text-white py-2 px-4 rounded-md text-sm font-medium transition-all duration-200 flex items-center justify-center gap-2 border border-primary-dark/20 hover:shadow-sm active:scale-[0.98]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="group-hover:animate-[pulse_1.5s_ease-in-out_infinite]">Sewa Sekarang</span>
        </button>
    </div>
</a>