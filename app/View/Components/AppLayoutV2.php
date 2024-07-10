<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayoutV2 extends Component
{
    public $menuActive;
    public $title;
    public $menuOpen;
    public function __construct($menuActive = null, $title = null, $menuOpen = null)
    {
        $this->menuActive = $menuActive;
        $this->title = $title;
        $this->menuOpen = $menuOpen;
    }

    public function render(): View|Closure|string
    {
        return view('present-track-v2.templates.app-layout');
    }
}
