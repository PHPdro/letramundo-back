<?php

namespace Database\Seeders;

use App\Models\Theme;
use App\Models\User;
use App\Models\Student;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $themes = [
            [
                'name' => 'Dinossauros',
            ],
            [
                'name' => 'Praia',
            ],
            [
                'name' => 'Alimentos',
            ],
        ];

        foreach ($themes as $theme) {
            Theme::create($theme);
        }
    }
}
