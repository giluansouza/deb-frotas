<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    public function __construct(
        public string $color = 'gray',
        public bool $bold = false,
    ) {}

    public function render(): View|string
    {
        return view('components.badge');
    }
}
