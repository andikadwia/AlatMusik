@props(['review'])

<div class="card bg-secondary rounded-lg p-8 group relative overflow-hidden transition-all duration-500 ease-in-out hover:shadow-xl">
    <!-- Background animation -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-700"></div>
    
    <!-- User profile section with animations -->
    <div class="flex items-center mb-5 relative z-10">
        <!-- Profile image container with glowing effect -->
        <div class="relative mr-4">
            <div class="absolute inset-0 bg-primary rounded-full opacity-0 group-hover:opacity-30 transform scale-0 group-hover:scale-150 blur-md transition-all duration-700"></div>
            <img 
                src="{{ $review['image'] }}" 
                alt="{{ $review['name'] }}" 
                class="w-12 h-12 rounded-full relative z-10 transition-all duration-500 group-hover:scale-110 group-hover:shadow-lg"
            />
        </div>
        
        <h3 class="font-medium text-lg transition-all duration-300 group-hover:text-primary group-hover:translate-x-1">
            {{ $review['name'] }}
        </h3>
    </div>
    
    <!-- Rating with animation -->
    <div class="flex items-center mb-2 relative z-10">
        <span class="text-yellow-400 text-lg transition-all duration-500 group-hover:text-yellow-300 group-hover:tracking-wider">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $review['rating'])
                    <span class="transition-transform duration-300 inline-block group-hover:scale-110 group-hover:rotate-3">★</span>
                @else
                    <span class="transition-transform duration-300 inline-block group-hover:scale-110 group-hover:rotate-3">☆</span>
                @endif
            @endfor
        </span>
        <span class="ml-1 transition-all duration-300 group-hover:font-semibold">({{ $review['rating'] }}/5)</span>
    </div>
    
    <!-- Review content with animated background -->
    <div class="relative z-10 overflow-hidden">
        <p class="text-sm transition-all duration-500">{!! nl2br(e($review['content'])) !!}</p>
        
        <!-- Read more button that slides in -->
        <div class="mt-4 transform translate-y-8 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
            <button class="btn btn-primary btn-sm relative overflow-hidden group-hover:shadow-md">
                <span class="relative z-10">Baca Selengkapnya</span>
                <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transform -translate-x-full group-hover:translate-x-full transition-all duration-700"></div>
            </button>
        </div>
    </div>
    
    <!-- Corner decoration -->
    <div class="absolute -bottom-16 -right-16 w-32 h-32 bg-primary rounded-full opacity-0 group-hover:opacity-10 transform scale-0 group-hover:scale-100 transition-all duration-700 delay-100"></div>
</div>