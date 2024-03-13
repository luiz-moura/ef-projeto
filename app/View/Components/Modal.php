<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public function __construct(
        public $target,
        public $title = null,
        public $cancelButton = 'yes',
        public $exitButton = 'yes',
    )
    {
    }

    public function render()
    {
        return view('components.modal');
    }
}
