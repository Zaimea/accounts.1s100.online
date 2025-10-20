<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarLink extends Component
{
    public function render(): View
	{
		return view('components.sidebar-link');
	}
}
