<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;

class ConstructorController extends Controller
{
    public function index(Request $request)
    {
        // Create a query to find users with Constructor role
        $constructor_query = User::where('role', 'Constructor')
            ->with(['skills', 'experience', 'works']);
        
        // Check for search parameter
        if ($request->filled('search')) {
            $search_term = $request->search;
            $constructor_query->where(function($query) use ($search_term) {
                $query->where('username', 'like', "%{$search_term}%")
                  ->orWhereHas('skills', function($skill_query) use ($search_term) {
                      $skill_query->where('name', 'like', "%{$search_term}%");
                  });
            });
        }
        
        // Filter constructors by specialty if provided
        if ($request->filled('specialty')) {
            $specialty_filter = $request->specialty;
            $constructor_query->whereHas('skills', function($query) use ($specialty_filter) {
                $query->where('name', $specialty_filter);
            });
        }
        
        // Get constructors with pagination
        $constructors = $constructor_query->paginate(9);
        
        // Get all skills for filter dropdown
        $skills = Skill::orderBy('name')->get();
        
        // Return the hire-constructor view with data
        return view('hire-constructor', compact('constructors', 'skills'));
    }
    

}