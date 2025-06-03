<?php

namespace Database\Seeders;

use App\Models\Theme;
use App\Models\User;
use App\Models\Student;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Level;
use App\Models\Phase;

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
            'password' => Hash::make('password'),
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

        Level::create([
            'level' => 1,
            'title' => 'Nível 1 - Vogais',
        ]);
        Level::create([
            'level' => 2,
            'title' => 'Nível 2 - Consoante V',
        ]);

        Level::create([
            'level' => 3,
            'title' => 'Nível 3 - Consoante F',
        ]);

        Level::create([
            'level' => 4,
            'title' => 'Nível 4 - Consoante L',
        ]);

        for ($i = 1; $i <= 10; $i++) {
            Phase::create([
                'phase' => $i,
                'level_id' => 1,
            ]);
        }

        for ($i = 1; $i <= 8; $i++) {
            Phase::create([
                'phase' => $i,
                'level_id' => 2,
            ]);
        }

        for ($i = 1; $i <= 8; $i++) {
            Phase::create([
                'phase' => $i,
                'level_id' => 3,
            ]);
        }

        for ($i = 1; $i <= 8; $i++) {
            Phase::create([
                'phase' => $i,
                'level_id' => 4,
            ]);
        }
    }
}
