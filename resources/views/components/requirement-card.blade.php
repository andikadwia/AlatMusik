@props(['requirement'])

<div class="card bg-base-100 shadow-md rounded-lg p-8 relative group overflow-hidden transition-all duration-500 ease-in-out hover:shadow-xl">
    <!-- Background decoration effects -->
    <div class="absolute -right-12 -top-12 w-24 h-24 bg-primary rounded-full opacity-0 group-hover:opacity-10 transform scale-0 group-hover:scale-100 transition-all duration-700 ease-out"></div>
    <div class="absolute -left-12 -bottom-12 w-24 h-24 bg-primary rounded-full opacity-0 group-hover:opacity-10 transform scale-0 group-hover:scale-100 transition-all duration-700 delay-100 ease-out"></div>
    
    <!-- Border effect that animates in -->
    <div class="absolute inset-0 border-2 border-primary border-opacity-0 group-hover:border-opacity-30 rounded-lg transform scale-90 group-hover:scale-100 transition-all duration-500"></div>
    
    <!-- Icon with enhanced animation -->
    <div class="relative z-10 mb-5 overflow-hidden">
        <img 
            src="{{ $requirement['icon'] }}" 
            alt="{{ $requirement['title'] }}" 
            class="w-16 h-16 transition-all duration-700 group-hover:scale-110 group-hover:rotate-3"
        />
        <div class="absolute inset-0 bg-primary bg-opacity-0 group-hover:bg-opacity-10 rounded-full transition-all duration-300"></div>
    </div>
    
    <!-- Content with sliding effects -->
    <h3 class="font-semibold text-lg mb-2 relative z-10 transition-all duration-300 group-hover:translate-x-1 group-hover:text-primary">
        {{ $requirement['title'] }}
    </h3>
    <p class="text-sm relative z-10 transition-all duration-500 group-hover:translate-y-1">{!! nl2br(e($requirement['description'])) !!}</p>
    
    <!-- Shine effect overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-0 group-hover:opacity-20 transform -translate-x-full group-hover:translate-x-full transition-all duration-1000 pointer-events-none"></div>
</div>