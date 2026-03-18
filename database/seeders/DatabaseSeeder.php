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
                'name' => 'Cowboy',
            ],
            [
                'name' => 'Animais',
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

        $levelTitles = [
            1 => 'Nível 1 - Vogais',
            2 => 'Nível 2 - Consoante V',
            3 => 'Nível 3 - Consoante F',
            4 => 'Nível 4 - Consoante L',
            5 => 'Nível 5',
            6 => 'Nível 6',
            7 => 'Nível 7',
            8 => 'Nível 8',
            9 => 'Nível 9',
            10 => 'Nível 10',
            11 => 'Nível 11',
            12 => 'Nível 12',
        ];

        foreach ($levelTitles as $levelNumber => $title) {
            $level = Level::create([
                'level' => $levelNumber,
                'title' => $title,
            ]);

            // Garante pelo menos a fase 1 para cada nível (necessário para cadastro de alunos em qualquer nível).
            Phase::create([
                'phase' => 1,
                'level_id' => $level->id,
            ]);
        }
    }
}
