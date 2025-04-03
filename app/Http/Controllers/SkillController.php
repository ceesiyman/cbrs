<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function store(Request $request)
    {
        $skillId = $request->skill;
        
        // If it's a new skill
        if (!is_numeric($skillId)) {
            $skill = Skill::create(['name' => $skillId]);
            $skillId = $skill->id;
        }

        auth()->user()->skills()->syncWithoutDetaching([$skillId]);

        return redirect()->back()->with('success', 'Skill added successfully!');
    }

    public function destroy(Skill $skill)
    {
        auth()->user()->skills()->detach($skill->id);
        return redirect()->back()->with('success', 'Skill removed successfully!');
    }
} 