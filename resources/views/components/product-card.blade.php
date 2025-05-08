@props(['product'])

<a href="/products/{{ $product['id'] }}" class="block"> <!-- Tambahkan link ke halaman detail -->
    <div class="card bg-base-100 shadow-sm relative group overflow-hidden rounded-lg transition-all duration-300 hover:shadow-lg">
        <!-- Subtle overlay on hover -->
        <div class="absolute inset-0 bg-primary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        <figure class="h-48 overflow-hidden">
            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" 
                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
        </figure>
        
        <div class="card-body p-5">
            <h3 class="font-semibold text-lg transition-colors duration-200 group-hover:text-primary">
                {{ $product['name'] }}
            </h3>
            <p class="text-gray-600 text-sm">{{ $product['category'] }}</p>
            
            <div class="flex items-center mt-2">
                <span class="text-yellow-400">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($product['rating']))
                            ★
                        @elseif ($i - 0.5 == floor($product['rating']))
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                </span>
                <span class="ml-1 text-sm">({{ $product['rating'] }}/5)</span>
            </div>
            
            <div class="flex justify-between items-center mt-3">
                <p class="font-bold transition-colors duration-200 group-hover:text-primary">
                    ({{ $product['price'] }})
                </p>
                
                @if($product['availability'])
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Tersedia</span>
                @else
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Tidak Tersedia</span>
                @endif
            </div>
        </div>
    </div>
</a>