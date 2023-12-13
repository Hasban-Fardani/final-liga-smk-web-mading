<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $text_color = "text-white", 
        public string $bg_color = "bg-blue-600", 
        public string $text = "Badge",
        public string $top = "top-0",
        public string $right = "right-0",
        public string $bottom = "",
        public string $left = "",
        ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.badge');
    }
}
