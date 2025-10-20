<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

class Footer extends Component
{
    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-footer' => '$refresh',
    ];

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('partials.footer');
    }
}
