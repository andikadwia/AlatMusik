@props(['requirement'])

@php
    // Batas karakter untuk read more
    $maxLength = 200;
    $description = $requirement['description'];
    $isLongText = strlen($description) > $maxLength;
    $shortDescription = $isLongText ? substr($description, 0, $maxLength) . '...' : $description;
    $uniqueId = 'req-' . uniqid();
@endphp

<div class="card bg-white shadow-xl rounded-xl p-8 relative group overflow-hidden transition-all duration-300 hover:shadow-2xl w-full min-h-[480px] h-auto"> <!-- Hapus min-h jika ingin sepenuhnya fleksibel -->
    
    <!-- Background effects -->
    <div class="absolute -right-16 -top-16 w-32 h-32 bg-primary rounded-full opacity-0 group-hover:opacity-10 transform scale-0 group-hover:scale-100 transition-all duration-500 ease-out"></div>
    <div class="absolute -left-16 -bottom-16 w-32 h-32 bg-primary rounded-full opacity-0 group-hover:opacity-10 transform scale-0 group-hover:scale-100 transition-all duration-500 delay-100 ease-out"></div>
    
    <!-- Border effect -->
    <div class="absolute inset-0 border-2 border-primary border-opacity-0 group-hover:border-opacity-30 rounded-xl transition-all duration-300"></div>
    
    <!-- Content container -->
    <div class="h-full flex flex-col">
        <!-- Icon section -->
        <div class="relative z-10 mb-6 flex justify-center">
            <div class="w-20 h-20 p-3 bg-primary bg-opacity-5 rounded-full transition-all duration-300 group-hover:bg-opacity-20">
                <img 
                    src="{{ $requirement['icon'] }}" 
                    alt="{{ $requirement['title'] }}" 
                    class="w-full h-full object-contain transition-all duration-500 group-hover:scale-110"
                    onerror="this.onerror=null;this.src='https://via.placeholder.com/80?text=Icon'"
                />
            </div>
        </div>
        
        <!-- Text content -->
        <div class="flex flex-col flex-1">
            <!-- Title -->
            <h3 class="font-bold text-xl mb-4 text-center line-clamp-2">
                {{ $requirement['title'] }}
            </h3>
            
            <!-- Description dengan read more -->
            <div class="flex-1">
                @if ($isLongText)
                    <div id="content-{{ $uniqueId }}" class="text-gray-600 text-base leading-relaxed">
                        <div id="short-{{ $uniqueId }}">
                            {!! nl2br(e($shortDescription)) !!}
                        </div>
                        <div id="full-{{ $uniqueId }}" class="hidden">
                            {!! nl2br(e($description)) !!}
                        </div>
                    </div>
                    <button 
                        onclick="toggleReadMore('{{ $uniqueId }}')"
                        id="btn-{{ $uniqueId }}"
                        class="text-primary hover:text-primary-dark font-medium mt-3 transition-colors duration-200 focus:outline-none text-left"
                    >
                        Read more
                    </button>
                @else
                    <div class="text-gray-600 text-base leading-relaxed">
                        {!! nl2br(e($description)) !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Shine effect -->
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/50 to-transparent opacity-0 group-hover:opacity-30 transform -translate-x-full group-hover:translate-x-full transition-all duration-700 pointer-events-none"></div>
</div>

@if ($isLongText)
@push('scripts')
<script>
    function toggleReadMore(id) {
        const short = document.getElementById(`short-${id}`);
        const full = document.getElementById(`full-${id}`);
        const btn = document.getElementById(`btn-${id}`);
        const card = btn.closest('.card'); // Dapatkan elemen card terdekat
        
        if (full.classList.contains('hidden')) {
            short.classList.add('hidden');
            full.classList.remove('hidden');
            btn.textContent = 'Read less';
            // Hapus min-height saat expanded
            card.style.minHeight = 'auto';
        } else {
            short.classList.remove('hidden');
            full.classList.add('hidden');
            btn.textContent = 'Read more';
        }
    }
</script>
@endpush
@endif