<?php

declare(strict_types=1);

namespace App\Accounts;

class CreateUser
{
    public static function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:50', 'unique:users', 'alpha_num'],
            'birthday' => ['nullable', 'date', 'before_or_equal:'.now()->subYears(16)],
        ];
    }

    public static function inputs($input): array
    {
        $fields = array_keys(self::rules());

        return collect($fields)
            ->mapWithKeys(fn($field) => [$field => $input[$field] ?? null])
            ->toArray();
    }

    public static function callbacks($user): void
    {
        // $user->roles()->attach(2);
        // \Zaimea\Groups\Group::createGroup($user);
    }
}
