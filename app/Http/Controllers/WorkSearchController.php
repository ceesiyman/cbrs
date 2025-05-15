<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WorkSearchController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/search-works",
     *     operationId="searchWorks",
     *     tags={"Works"},
     *     summary="Search for works",
     *     description="Search for works by title, description, skills, or time period",
     *     @OA\Parameter(
     *         name="query",
     *         in="query",
     *         required=false,
     *         description="Search query string for title or description",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="skills",
     *         in="query",
     *         required=false,
     *         description="Comma-separated skill IDs to filter by",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="time",
     *         in="query",
     *         required=false,
     *         description="Time period filter (today, week, month)",
     *         @OA\Schema(type="string", enum={"today", "week", "month"})
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Building Construction Project"),
     *                 @OA\Property(property="description", type="string", example="We need help with a building construction project."),
     *                 @OA\Property(property="budget", type="number", format="float", example=500000),
     *                 @OA\Property(property="created_at_human", type="string", example="2 days ago"),
     *                 @OA\Property(property="skills", type="array", @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Masonry")
     *                 )),
     *                 @OA\Property(property="client", type="string", example="ClientUsername")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="An error occurred while searching."),
     *             @OA\Property(property="message", type="string", example="Error message details")
     *         )
     *     )
     * )
     */
    public function search(Request $request)
    {
        try {
            $query = $request->input('query');
            $skills = $request->input('skills');
            $time = $request->input('time');

            $works = Work::query()
                ->where('assigned', false)
                ->when($query, function ($q) use ($query) {
                    return $q->where(function ($q) use ($query) {
                        $q->where('title', 'like', "%{$query}%")
                          ->orWhere('description', 'like', "%{$query}%");
                    });
                })
                ->when($skills && !empty($skills), function ($q) use ($skills) {
                    $skillIds = explode(',', $skills);
                    return $q->whereHas('skills', function ($q) use ($skillIds) {
                        $q->whereIn('skills.id', $skillIds);
                    });
                })
                ->when($time, function ($q) use ($time) {
                    return $q->when($time === 'today', function ($q) {
                        return $q->whereDate('created_at', Carbon::today());
                    })->when($time === 'week', function ($q) {
                        return $q->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    })->when($time === 'month', function ($q) {
                        return $q->whereMonth('created_at', Carbon::now()->month);
                    });
                })
                ->with(['skills', 'client'])
                ->latest();

            // Let's debug the generated SQL query
            Log::info('Search Query SQL:', [
                'sql' => $works->toSql(),
                'bindings' => $works->getBindings()
            ]);

            $results = $works->get()->map(function ($work) {
                return [
                    'id' => $work->id,
                    'title' => $work->title,
                    'description' => $work->description,
                    'budget' => $work->budget,
                    'created_at_human' => $work->created_at->diffForHumans(),
                    'skills' => $work->skills,
                    'client' => $work->client->username
                ];
            });

            return response()->json($results);

        } catch (\Exception $e) {
            Log::error('Work Search Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'query' => $request->all()
            ]);

            return response()->json([
                'error' => 'An error occurred while searching.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 