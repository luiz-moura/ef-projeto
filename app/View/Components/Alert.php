<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public function __construct(
        public $type    = 'success',
        public $message = null
    )
    {
    }

    public function render()
    {
        return view('components.alert');
    }
}
