<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectEstados extends Component
{
    public function __construct(public $select = null)
    {
    }

    public function render()
    {
        return view('components.select-estados');
    }
}
