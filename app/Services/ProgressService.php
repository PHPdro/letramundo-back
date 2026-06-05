<?php

namespace App\Services;

use App\Models\Level;
use App\Models\Phase;
use App\Models\Progress;

class ProgressService {

    public function storeProgress(array $data): array
    {
        $progress = Progress::create($data);
        $response = [
            "data" => [
                "student_id" => $progress->student_id,
                "phase_id" => $progress->phase_id,
            ]
        ];
        return $response;
    }

    public function getProgress(string $id): array
    {
        
        $progress = Progress::where('student_id', $id)->firstOrFail();
        $response = [
            "data" => [
                "student_id" => $progress->student_id,
                "phase_id" => $progress->phase_id,
            ]
        ];

        return $response;
    }

    public function setPhaseForStudent(string $studentId, int $phaseId): array
    {
        $progress = Progress::where('student_id', $studentId)->firstOrFail();
        $progress->update([
            'phase_id' => $phaseId,
        ]);

        return [
            "data" => [
                "student_id" => $progress->student_id,
                "phase_id" => $progress->phase_id,
            ]
        ];
    }

    public function updateProgress(string $studentId): array
    {
        $progress = Progress::where('student_id', $studentId)->firstOrFail();
        $currentPhase = Phase::findOrFail($progress->phase_id);

        $nextPhase = Phase::where('level_id', $currentPhase->level_id)
            ->where('phase', $currentPhase->phase + 1)
            ->first();

        if (!$nextPhase) {
            $currentLevel = Level::findOrFail($currentPhase->level_id);
            $nextLevel = Level::where('level', $currentLevel->level + 1)->first();

            if (!$nextLevel) {
                throw new \Exception("Parabéns! Todos os níveis foram concluídos.");
            }

            $nextPhase = Phase::where('level_id', $nextLevel->id)
                ->orderBy('phase')
                ->firstOrFail();
        }

        $progress->update(['phase_id' => $nextPhase->id]);

        return [
            "data" => [
                "student_id" => $progress->student_id,
                "phase_id" => $progress->phase_id,
            ]
        ];
    }
}