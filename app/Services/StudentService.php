<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Theme;
use App\Models\Level;
use App\Models\Phase;
use App\Services\ProgressService;
use Illuminate\Support\Facades\Auth;

class StudentService
{
    public function storeStudent(array $data): array
    {
        $levelNumber = $data['level'] ?? 1;
        unset($data['level']);
        $data['user_id'] = Auth::id();

        $student = Student::create($data);

        $level = Level::where('level', $levelNumber)->firstOrFail();
        $phaseId = Phase::where('level_id', $level->id)->orderBy('phase')->value('id');
        if (!$phaseId) {
            throw new \Exception("Não existe fase cadastrada para o nível {$levelNumber}.");
        }

        $progressData = [
            'student_id' => $student->id,
            'phase_id' => $phaseId,
            'is_completed' => false,
        ];

        $progress = (new ProgressService())->storeProgress($progressData);

        $response = [
            "data" => [
                "id" => $student->id,
                "name" => $student->name,
                "year" => $student->year,
                "class" => $student->class,
                "avatar" => $student->avatar,
                "phase_id" => $progress['data']['phase_id'],
            ]
        ];

            return $response;
    }

    public function getStudents(string $id): array
    {
        if (empty($id)) {
            $students = Student::where('user_id', Auth::id())->get();
            foreach ($students as $student) {
                $theme = Theme::find($student->theme_id);
                $progress = (new ProgressService())->getProgress($student->id);
                $phase = Phase::find($progress['data']['phase_id']);
                $level = Level::find($phase->level_id);
                $student->level = $level->level;
                $student->phase = $phase->phase;
                $student->theme = $theme->name;
                $student->phase_id = $phase->id;
            }

            $response = [
                "data" => [
                    "students" => $students
                ]
                ];
        } else {
            $student = Student::findOrFail($id);
            $theme = Theme::find($student->theme_id);
            $progress = (new ProgressService())->getProgress($student->id);
            $phase = Phase::find($progress['data']['phase_id']);
            $level = Level::find($phase->level_id);
            $response = [
                "data" => [
                    "id" => $student->id,
                    "name" => $student->name,
                    "year" => $student->year,
                    "class" => $student->class,
                    "avatar" => $student->avatar,
                    "theme" => $theme->name,
                    "level" => $level->level,
                    "phase" => $phase->phase,
                    "phase_id" => $phase->id,
                ]
            ];
        }

        return $response;
    }

    public function updateStudent(array $data, string $id): array
    {
        $student = Student::findOrFail($id);
        $levelNumber = $data['level'] ?? null;
        unset($data['level']);
        $student->update($data);

        if ($levelNumber !== null) {
            $level = Level::where('level', $levelNumber)->firstOrFail();
            $phaseId = Phase::where('level_id', $level->id)->orderBy('phase')->value('id');
            if (!$phaseId) {
                throw new \Exception("Não existe fase cadastrada para o nível {$levelNumber}.");
            }
            (new ProgressService())->setPhaseForStudent((string)$student->id, (int)$phaseId);
        }

        $response = [
            "data" => [
                "id" => $student->id,
                "name" => $student->name,
                "year" => $student->year,
                "class" => $student->class,
                "avatar" => $student->avatar,
            ]
        ];

        return $response;
    }

    public function deleteStudent(string $id): array
    {
        $student = Student::findOrFail($id);
        $student->delete();

        $response = [
            "data" => [
                "message" => 'Aluno deletado com sucesso.'
            ]
        ];

        return $response;
    }
}