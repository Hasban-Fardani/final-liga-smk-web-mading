<!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
<div class="text-white text-xs shadow-md px-3 py-1 max-w-fit z-50
    {{ $position }} 
    {{ $class }}
    {{ $color === 'other' ? 'bg-yellow-500' : '' }}
    {{ $color === 'secondary' ? 'bg-green-500' : '' }}
    {{ $color === 'primary' ? 'bg-blue-500' : '' }}">
    <p>{{ $text }}</p>
</div>
