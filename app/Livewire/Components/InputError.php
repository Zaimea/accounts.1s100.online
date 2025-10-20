<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputError extends Component
{
    public function render(): View
	{
		return view('components.input-error');
	}
}
