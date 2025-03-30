<div>
    @if(session('success') || session('error') || session('warning'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-transition.duration.500ms
            x-init="setTimeout(() => show = false, 5000)" 
            class="fixed top-5 right-5 z-50 max-w-xs w-full"
        >
            @if(session('success'))
                <div class="flex items-center gap-3 bg-white border-l-4 border-green-500 text-black p-4 shadow-lg rounded-lg">
                    <x-heroicon-o-check-circle class="w-6 h-6 text-green-600" />
                    <div class="flex-1">
                        <strong class="block">Éxito</strong>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-green-700 hover:text-green-900 transition">
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                    </button>
                </div>
            @elseif(session('error'))
                <div class="flex items-center gap-3 bg-white border-l-4 border-red-500 text-black p-4 shadow-lg rounded-lg">
                    <x-heroicon-o-x-circle class="w-6 h-6 text-red-600" />
                    <div class="flex-1">
                        <strong class="block">Error</strong>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="text-red-700 hover:text-red-900 transition">
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                    </button>
                </div>
            @elseif(session('warning'))
                <div class="flex items-center gap-3 bg-white border-l-4 border-yellow-500 text-black p-4 shadow-lg rounded-lg">
                    <x-heroicon-o-exclamation-triangle class="w-6 h-6 text-yellow-600" />
                    <div class="flex-1">
                        <strong class="block">Advertencia</strong>
                        <span>{{ session('warning') }}</span>
                    </div>
                    <button @click="show = false" class="text-yellow-700 hover:text-yellow-900 transition">
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                    </button>
                </div>
            @endif
        </div>
    @endif
</div>