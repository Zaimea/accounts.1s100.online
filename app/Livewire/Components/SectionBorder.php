<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionBorder extends Component
{
    public function render(): View
	{
		return view('components.section-border');
	}
}
