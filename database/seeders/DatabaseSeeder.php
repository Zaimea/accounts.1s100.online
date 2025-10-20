<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            'Laur Example' => 'laurentiu@example.com',
            'Custura Laurentiu' => 'mail@custura.de',
            'Custura Madalina' => 'madalina@custura.de',
        ];

        foreach ($users as $name => $email) {
            DB::transaction(function () use ($name, $email) {
                return tap(User::create([
                    'name' => $name,
                    'username' => Str::slug($name, '-'),
                    'email' => $email,
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                ]));
          });
        }
    }
}
