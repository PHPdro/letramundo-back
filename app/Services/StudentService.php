<?php

namespace App\Services;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentService
{
    public function storeStudent(array $data): array
    {

        $data['user_id'] = Auth::id();

        $student = Student::create($data);

        $response = [
            "data" => [
                "id" => $student->id,
                "name" => $student->name,
                "age" => $student->age,
                "year" => $student->year,
                "class" => $student->class,
            ]
        ];

            return $response;
    }

    public function getStudents(string $id): array
    {
        if (empty($id)) {
            $student = Student::all();
            $response = [
                "data" => [
                    "students" => $student
                ]
                ];
        } else {
            $student = Student::findOrFail($id);
            $response = [
                "data" => [
                    "id" => $student->id,
                    "name" => $student->name,
                    "age" => $student->age,
                    "year" => $student->year,
                    "class" => $student->class,
                ]
            ];
        }

        return $response;
    }
}