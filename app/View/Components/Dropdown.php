<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\SubCategory;

class Dropdown extends Component
{
    //public $subcategory;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $subcategory,
    )
    {
        $this->subcategory = $subcategory;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown');
    }
}
