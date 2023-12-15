<!-- An unexamined life is not worth living. - Socrates -->
<div class="w-fit fixed bottom-4 right-4 animate-fade-left animate-delay-300 alert z-50">
    <div class="
    {{ $type === 'error' ? 'bg-red-500' : '' }}
    {{ $type === 'warning' ? 'bg-yellow-500' : '' }}    
    {{ $type === 'success' ? 'bg-green-500' : '' }}    
    {{ $type === 'info' ? 'bg-blue-500' : '' }}    
    text-white rounded-lg py-3 px-6 flex justify-between items-center">
        <p class="">{{ $message}}</p>
        <button onclick="this.parentElement.parentElement.remove()" class="py-1 px-2">x</button>
    </div>
</div>