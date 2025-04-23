<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;
use Illuminate\Http\JsonResponse;

class ThemeController extends Controller
{

    /**
     * @OA\Get(
     *    path="/api/themes",
     *    operationId="getAllThemes",
     *    tags={"Themes"},
     *    summary="Get all themes",
     *    description="Get all themes",
     *     @OA\Response(
     *       response=200,
     *       description="Themes retrieved successfully",
     *       @OA\JsonContent()
     *    ),
     *
     *      @OA\Response(
     *       response=404,
     *       description="No themes found",
     *       @OA\JsonContent()
     *   ),
     * )
     */

    public function show() : JsonResponse
    {
        $themes = Theme::all();

        return response()->json([
            'data' => [
                'themes' => $themes
            ]
        ]);
    }
}
