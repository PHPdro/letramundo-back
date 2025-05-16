<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;
use App\Services\ProgressService;
use Illuminate\Http\JsonResponse;

class ProgressController extends Controller
{

    /**
     * @OA\Put(
     *    path="/api/students/{id}/progress",
     *    operationId="storeProgress",
     *    tags={"Progress"},
     *    summary="Update student progress",
     *    description="Update student progress",
     *          @OA\RequestBody(
     *              @OA\JsonContent(),
     *              @OA\MediaType(
     *                 mediaType="multipart/form-data",
     *                 @OA\Schema(
     *                    type="object",
     *                    required={"student_id"},
     *                    @OA\Property(property="student_id", type="integer"),
     *               ),
     *          ),
     *      ),
     *     @OA\Response(
     *       response=201,
     *       description="Progress Updated",
     *       @OA\JsonContent()
     *    ),
     *     @OA\Response(
     *       response=422,
     *       description="Unprocessable Entity",
     *       @OA\JsonContent()
     *   ),
     * )
     */

    public function update(string $id): JsonResponse
    {
        try {
            $progress = (new ProgressService())->updateProgress($id);

            return response()->json($progress, 201);

        } catch(\Exception $e) {
            $response = [
                "data" => [
                    "message" => 'Erro ao atualizar progresso.',
                    "error" => $e->getMessage()
                ]
            ];

            return response()->json($response, 422);
        }
    }
}
