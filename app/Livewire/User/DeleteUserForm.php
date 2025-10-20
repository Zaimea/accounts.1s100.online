<?php

declare(strict_types=1);

namespace App\Livewire\User;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Zaimea\Groups\Fabric\Contracts\DeletesUsers;

class DeleteUserForm extends Component
{
    /**
     * Indicates if user deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingUserDeletion = false;

    /**
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /**
     * Confirm that the user would like to delete their account.
     *
     * @return void
     */
    public function confirmUserDeletion()
    {
        $this->resetErrorBag();

        $this->password = '';

        $this->dispatch('confirming-delete-user');

        $this->confirmingUserDeletion = true;
    }

    /**
     * Delete the current user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Zaimea\Groups\Fabric\Contracts\DeletesUsers  $deleter
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $auth
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function deleteUser(Request $request, DeletesUsers $deleter, StatefulGuard $auth)
    {
        $this->resetErrorBag();

        if (! Hash::check($this->password, $this->user->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        $deleter->delete($this->user->fresh());

        $auth->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect(config('fortify.redirects.logout') ?? '/');
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
        return view('users.profile.delete-user-form');
    }
}
