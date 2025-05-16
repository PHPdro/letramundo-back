<?php

namespace App\Services;

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
        
        $progress = Progress::findOrFail($id);
        $response = [
            "data" => [
                "student_id" => $progress->student_id,
                "phase_id" => $progress->phase_id,
            ]
        ];

        return $response;
    }

    public function updateProgress(string $id): array
    {
        $progress = Progress::findOrFail($id);
        $progress->update([
            'phase_id' => $progress->phase_id + 1,
        ]);

        $response = [
            "data" => [
                "student_id" => $progress->student_id,
                "phase_id" => $progress->phase_id,
            ]
        ];
        return $response;
    }
}