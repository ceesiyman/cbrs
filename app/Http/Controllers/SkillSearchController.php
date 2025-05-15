<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SkillSearchController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/search-skills",
     *     operationId="searchSkills",
     *     tags={"Skills"},
     *     summary="Search for skills",
     *     description="Search for skills by name",
     *     @OA\Parameter(
     *         name="query",
     *         in="query",
     *         description="Search query for skill name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Carpentry"),
     *                 @OA\Property(property="category", type="string", example="Construction"),
     *                 @OA\Property(property="description", type="string", example="Skill in working with wood to create structures"),
     *                 @OA\Property(property="icon", type="string", example="fa-hammer")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="An error occurred while processing your request"),
     *             @OA\Property(property="message", type="string", example="Database connection error")
     *         )
     *     )
     * )
     */
    public function search(Request $request)
    {
        try {
            $query = $request->input('query');
            
            $skills = Skill::query();
            
            if ($query) {
                $skills->where('name', 'LIKE', "%{$query}%");
            }
            
            $results = $skills->get();
            
            return response()->json($results);
            
        } catch (\Exception $e) {
            Log::error('Skill Search Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all()
            ]);
            
            return response()->json([
                'error' => 'An error occurred while processing your request',
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 