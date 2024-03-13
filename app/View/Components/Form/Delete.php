<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Delete extends Component
{
    public function __construct(
        public $text    = 'Deletar',
        public $action  = null,
        public $target  = null,
    )
    {
    }

    public function render()
    {
        return view('components.form.delete');
    }
}
