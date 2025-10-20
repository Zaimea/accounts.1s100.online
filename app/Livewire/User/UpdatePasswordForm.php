<?php

declare(strict_types=1);

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Zaimea\Groups\Fabric\Contracts\UpdatesUserPasswords;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [
        'current_password'      => '',
        'password'              => '',
        'password_confirmation' => '',
    ];

    /**
     * Update the user's password.
     *
     * @param  \Zaimea\Groups\Fabric\Contracts\UpdatesUserPasswords  $updater
     * @return void
     */
    public function updatePassword(UpdatesUserPasswords $updater)
    {
        $this->resetErrorBag();

        $updater->update($this->user, $this->state);

        if (request()->hasSession()) {
            request()->session()->put([
                'password_hash_'.Auth::getDefaultDriver() => $this->user->getAuthPassword(),
            ]);
        }

        $this->state = [
            'current_password'      => '',
            'password'              => '',
            'password_confirmation' => '',
        ];

        $this->dispatch('saved');
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('users.profile.update-password-form');
    }
}
