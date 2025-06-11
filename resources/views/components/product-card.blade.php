@props(['product'])

<a href="{{ route('products.show', $product->id) }}" class="block">
    <div class="card bg-base-100 shadow-sm relative group overflow-hidden rounded-lg transition-all duration-300 hover:shadow-lg">
        <!-- Subtle overlay on hover -->
        <div class="absolute inset-0 bg-primary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        <figure class="h-48 overflow-hidden">
            <img src="{{ $product->image }}" alt="{{ $product->name }}"
                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
        </figure>
        
        <div class="card-body p-5">
            <h3 class="font-semibold text-lg transition-colors duration-200 group-hover:text-primary">
                {{ $product->name }}
            </h3>
            <p class="text-gray-600 text-sm">{{ $product->category }}</p>
            
            <div class="flex items-center mt-2">
                <span class="text-yellow-400">
                    @php
                        $rating = $product->rating ?? 0;
                        $fullStars = floor($rating);
                        $hasHalfStar = (fmod($rating, 1) >= 0.5);
                    @endphp
                    
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $fullStars)
                            {{-- Bintang penuh --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @elseif ($i == $fullStars + 1 && $hasHalfStar)
                            {{-- Bintang setengah --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                <defs>
                                    <linearGradient id="half-star-{{ $i }}" x1="0" x2="100%" y1="0" y2="0">
                                        <stop offset="50%" stop-color="currentColor" />
                                        <stop offset="50%" stop-color="#d1d5db" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#half-star-{{ $i }})" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @else
                            {{-- Bintang kosong --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        @endif
                    @endfor
                </span>
                <span class="ml-1 text-sm">
                    ({{ number_format($rating, 1) }})
                    @if(isset($product->review_count))
                        <span class="text-gray-500 text-xs">({{ $product->review_count }})</span>
                    @endif
                </span>
            </div>
            
            <div class="flex justify-between items-center mt-3">
                <p class="font-bold transition-colors duration-200 group-hover:text-primary">Rp
                    {{ number_format($product->price, 0, ',', '.') }}
                </p>

                @php
                    $stock = $product->stock ?? 0;
                    $stock = is_numeric($stock) ? (int)$stock : 0;
                @endphp

                @if($stock > 0)
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        Tersedia
                    </span>
                @else
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        Tidak Tersedia
                    </span>
                @endif
            </div>
        </div>
    </div>
</a>