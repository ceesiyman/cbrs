<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConstructorSearchController extends Controller
{
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