<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SliderV2 extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $posts = [])
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.slider-v2', [
            'posts' => $this->posts
        ]);
    }
}