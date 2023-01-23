<?php

namespace App\View\Components\user;

use Illuminate\View\Component;

class asidecategories extends Component
{
    public $categories;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.asidecategories');
    }
}
