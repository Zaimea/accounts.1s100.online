<?php

declare(strict_types=1);

namespace App\Accounts;

use App\Models\User;
use Illuminate\Validation\Rules\Password;

class CustomPasswordValidationRules
{
    /**
     * Get the custom validation rules used to validate passwords.
     *
     * @param  null|\App\Models\User  $user
     * @param  null|array<string, string>  $input
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    public static function customPasswordRules(?User $user = null, ?array $input = null): array
    {
        return ['required', 'string', Password::default(), 'confirmed'];
    }
}
