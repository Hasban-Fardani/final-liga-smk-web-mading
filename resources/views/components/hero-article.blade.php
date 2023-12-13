<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    <div>
        <x-mini-slider :posts="$posts" />
    </div>
    <div>
        <x-post-card :post="$posts[0]" />
    </div>
</div>