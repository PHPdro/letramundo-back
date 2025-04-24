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

        User::factory(1)->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
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

        Student::factory(3)->create();
    }
}
