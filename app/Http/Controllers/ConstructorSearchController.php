<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConstructorSearchController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/search-constructors",
     *     operationId="searchConstructors",
     *     tags={"Constructors"},
     *     summary="Search for constructors",
     *     description="Search for constructors by name or username",
     *     @OA\Parameter(
     *         name="query",
     *         in="query",
     *         required=true,
     *         description="Search query string",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="username", type="string", example="JohnDoe"),
     *                 @OA\Property(property="email", type="string", example="john@example.com"),
     *                 @OA\Property(property="image", type="string", example="path/to/image.jpg", nullable=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="An error occurred while searching. Please try again."),
     *             @OA\Property(property="message", type="string", example="Error message details")
     *         )
     *     )
     * )
     */
    public function search(Request $request)
    {
        try {
            $query = $request->input('query');

            if (empty($query)) {
                return response()->json([]);
            }

            Log::info('Searching constructors with query: ' . $query);

            $constructors = User::where('role', 'Constructor')
                ->where(function($q) use ($query) {
                    $q->where('username', 'like', '%' . $query . '%');
                })
                ->select(['id', 'username', 'email', 'image'])
                ->orderBy('username')
                ->limit(10)
                ->get();

            Log::info('Found ' . $constructors->count() . ' constructors');

            return response()->json($constructors);

        } catch (\Exception $e) {
            Log::error('Constructor search error: ' . $e->getMessage(), [
                'query' => $request->input('query'),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'error' => 'An error occurred while searching. Please try again.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 