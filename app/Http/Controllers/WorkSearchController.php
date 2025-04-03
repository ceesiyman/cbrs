<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkSearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $query = $request->input('query');
            $skills = $request->input('skills');
            $time = $request->input('time');
            $userId = auth()->id();

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
                ->with(['skills', 'client', 'bids' => function($query) use ($userId) {
                    $query->where('user_id', $userId);
                }])
                ->latest();

            // Debug the query
            \Log::info('Work Search Query:', [
                'sql' => $works->toSql(),
                'bindings' => $works->getBindings()
            ]);

            $results = $works->get()->map(function ($work) {
                $hasBid = $work->bids->isNotEmpty();
                $bidId = $hasBid ? $work->bids->first()->id : null;
                
                return [
                    'id' => $work->id,
                    'title' => $work->title,
                    'description' => $work->description,
                    'budget' => $work->budget,
                    'created_at_human' => $work->created_at->diffForHumans(),
                    'skills' => $work->skills,
                    'client' => $work->client->username,
                    'has_bid' => $hasBid,
                    'bid_id' => $bidId
                ];
            });

            return response()->json($results);

        } catch (\Exception $e) {
            \Log::error('Work Search Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'An error occurred while searching.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 