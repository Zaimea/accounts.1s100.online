<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImagePreviewModal extends Component
{
    public function render(): View
	{
		return view('components.image-preview-modal');
	}
}
