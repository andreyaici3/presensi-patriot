<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public $menuActive;
    public $menuOpen;
    public function __construct($menuActive = "dashboard", $menuOpen="dashboard")
    {
        $this->menuActive = $menuActive;
        $this->menuOpen = $menuOpen;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
