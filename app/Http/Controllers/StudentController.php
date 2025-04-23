<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\StudentService;
use App\Http\Requests\StudentRequest;

/**
 * @OA\Info(
 *      title="Student API",
 *      version="1.0.0",
 *      description="API for managing students",
 * )
 */

class StudentController extends Controller
{

    /**
     * @OA\Post(
     *    path="/api/students",
     *    operationId="storeStudent",
     *    tags={"Students"},
     *    summary="Store a new student",
     *    description="Store a new student",
     *          @OA\RequestBody(
     *              @OA\JsonContent(),
     *              @OA\MediaType(
     *                 mediaType="multipart/form-data",
     *                 @OA\Schema(
     *                    type="object",
     *                    required={"name", "year", "class", "theme_id"},
     *                    @OA\Property(property="name", type="string"),
     *                    @OA\Property(property="year", type="integer"),
     *                    @OA\Property(property="class", type="string"),
     *                    @OA\Property(property="user_id", type="integer"),
     *                    @OA\Property(property="theme_id", type="integer"),
     *               ),
     *          ),
     *      ),
     *     @OA\Response(
     *       response=201,
     *       description="Student Created",
     *       @OA\JsonContent()
     *    ),
     *     @OA\Response(
     *       response=422,
     *       description="Unprocessable Entity",
     *       @OA\JsonContent()
     *   ),
     * )
     */
    public function store(StudentRequest $request): JsonResponse
    {
        try {
            $student = (new StudentService())->storeStudent($request->validated());

            return response()->json($student, 201);

        } catch(\Exception $e) {
            $response = [
                "data" => [
                    "message" => 'Erro no cadastro.',
                    "error" => $e->getMessage()
                ]
            ];

            return response()->json($response, 422);
        }
    }

    /**
     * @OA\Get(
     *    path="/api/students/{id}",
     *    operationId="getStudent",
     *    tags={"Students"},
     *    summary="Get a student by ID",
     *    description="Get a student by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the student to retrieve",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *       response=200,
     *       description="Student retrieved successfully",
     *       @OA\JsonContent()
     *    ),
     *      @OA\Response(
     *       response=404,
     *       description="Student not found",
     *       @OA\JsonContent()
     *   ),
     * )
     */

    public function show(string $id): JsonResponse
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
     * @OA\Get(
     *    path="/api/students",
     *    operationId="getAllStudents",
     *    tags={"Students"},
     *    summary="Get all students",
     *    description="Get all students",
     *     @OA\Response(
     *       response=200,
     *       description="Students retrieved successfully",
     *       @OA\JsonContent()
     *    ),
     *
     *      @OA\Response(
     *       response=404,
     *       description="No students found",
     *       @OA\JsonContent()
     *   ),
     * )
     */

    public function showAll() : JsonResponse
    {
        try {
            $students = (new StudentService())->getStudents('');

            return response()->json($students, 200);

        } catch(\Exception $e) {
            $response = [
                "data" => [
                    "message" => 'Nenhum aluno encontrado.',
                    "error" => $e->getMessage()
                ]
            ];

            return response()->json($response, 404);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $student = (new StudentService())->updateStudent($request->validated(), $id);

            return response()->json($student, 200);

        } catch(\Exception $e) {
            $response = [
                "data" => [
                    "message" => 'Erro na atualização.',
                    "error" => $e->getMessage()
                ]
            ];

            return response()->json($response, 422);
        }
    }

    public function destroy(string $id)
    {
        try {
            $student = (new StudentService())->deleteStudent($id);

            return response()->json($student, 200);

        } catch(\Exception $e) {
            $response = [
                "data" => [
                    "message" => 'Erro na exclusão.',
                    "error" => $e->getMessage()
                ]
            ];

            return response()->json($response, 422);
        }
    }
}
