@props(['requirement'])

<div class="card bg-base-100 shadow-md rounded-lg p-6 relative group overflow-hidden transition-all duration-300 hover:shadow-xl h-64 w-full"> <!-- Fixed height and width -->
    
    <!-- Background decoration effects -->
    <div class="absolute -right-12 -top-12 w-24 h-24 bg-primary rounded-full opacity-0 group-hover:opacity-10 transform scale-0 group-hover:scale-100 transition-all duration-500 ease-out"></div>
    <div class="absolute -left-12 -bottom-12 w-24 h-24 bg-primary rounded-full opacity-0 group-hover:opacity-10 transform scale-0 group-hover:scale-100 transition-all duration-500 delay-100 ease-out"></div>
    
    <!-- Border effect -->
    <div class="absolute inset-0 border-2 border-primary border-opacity-0 group-hover:border-opacity-30 rounded-lg transition-all duration-300"></div>
    
    <!-- Content container with fixed height -->
    <div class="h-full flex flex-col">
        <!-- Icon with animation -->
        <div class="relative z-10 mb-4 flex justify-center"> <!-- Centered icon -->
            <div class="w-14 h-14 p-2 bg-primary bg-opacity-5 rounded-full transition-all duration-300 group-hover:bg-opacity-20">
                <img 
                    src="{{ $requirement['icon'] }}" 
                    alt="{{ $requirement['title'] }}" 
                    class="w-full h-full object-contain transition-all duration-500 group-hover:scale-110"
                    onerror="this.onerror=null;this.src='https://via.placeholder.com/56?text=Icon'"
                />
            </div>
        </div>
        
        <!-- Text content with fixed height and overflow -->
        <div class="flex-1 flex flex-col">
            <!-- Title with fixed height -->
            <h3 class="font-semibold text-lg mb-2 text-center line-clamp-2 h-14 overflow-hidden"> <!-- Fixed title height -->
                {{ $requirement['title'] }}
            </h3>
            
            <!-- Description with scroll if needed -->
            <div class="flex-1 overflow-y-auto custom-scrollbar"> <!-- Scrollable description -->
                <p class="text-sm text-gray-600 text-center px-2">
                    {!! nl2br(e($requirement['description'])) !!}
                </p>
            </div>
        </div>
    </div>
    
    <!-- Shine effect overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/50 to-transparent opacity-0 group-hover:opacity-30 transform -translate-x-full group-hover:translate-x-full transition-all duration-700 pointer-events-none"></div>
    
    <style>
        /* Custom scrollbar for description */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(160, 137, 99, 0.3);
            border-radius: 2px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(160, 137, 99, 0.5);
        }
    </style>
</div>