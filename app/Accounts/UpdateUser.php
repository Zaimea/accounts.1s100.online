<?php

declare(strict_types=1);

namespace App\Accounts;

class UpdateUser
{
    public static function rules($user, $input): array
    {
        return [
            'username'        => ['required', 'string', 'max:50', \Illuminate\Validation\Rule::unique('users')->ignore($user->id), 'alpha_num'],
            'birthday'        => ['nullable', 'date', 'before_or_equal:'.now()->subYears(16)],
            'gender'          => ['nullable', 'in:none,male,female,divers'],
            'country'         => ['nullable', 'string', 'max:45'],
            'town'            => ['nullable', 'string', 'max:45'],
            'website'         => ['nullable', 'url', 'string', 'max:45'],
            'about'           => ['nullable', 'string', 'max:256'],
            'userdescription' => ['nullable', 'string', 'max:628'],
        ];
    }

    public static function inputs($user, $input): array
    {
        $fields = array_keys(self::rules($user, $input));

        return collect($fields)
            ->mapWithKeys(fn($field) => [$field => $input[$field] ?? null])
            ->toArray();
    }

    public static function extra($user): void
    {
        // $user->sendEmailUpdateProfileNotification($user);
    }
}
