<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\StudentService;
use App\Http\Requests\StudentRequest;


class StudentController extends Controller
{

    public function store(StudentRequest $request): JsonResponse
    {
        try {
            $student = (new StudentService())->storeStudent($request->validated());

            return response()->json($student, 201);

        } catch(\Exception $e) {
            $response = [
                "data" => [
                    "message" => 'Aluno não cadastrado.',
                    "error" => $e->getMessage()
                ]
            ];

            return response()->json($response, 404);
        }
    }

    public function show(string|null $id = null): JsonResponse
    {
        try {
            $student = (new StudentService())->getStudents($id);

            return response()->json($student, 200);

        } catch(\Exception $e) {
            $response = [
                "data" => [
                    "message" => 'Aluno não encontrado.',
                    "error" => $e->getMessage()
                ]
            ];

            return response()->json($response, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
