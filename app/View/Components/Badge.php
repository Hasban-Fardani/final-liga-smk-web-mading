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
        public string $text = "Badge",
        public string $color = "primary",
        public string $position = "absolute",
        public string $class = "",
        public bool $tag = false,
        ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.badge', [
            'text' => $this->text,
            'color' => $this->color,
            'class' => $this->class
        ]);
    }
}
