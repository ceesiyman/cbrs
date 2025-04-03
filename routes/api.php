<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConstructorSearchController;
use App\Models\Work;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/search-constructors', [ConstructorSearchController::class, 'search']);

Route::get('/search-works', function (Request $request) {
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
        \Log::info('Search Query SQL:', [
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
        \Log::error('Work Search Error:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'query' => $request->all()
        ]);

        return response()->json([
            'error' => 'An error occurred while searching.',
            'message' => $e->getMessage()
        ], 500);
    }
}); 