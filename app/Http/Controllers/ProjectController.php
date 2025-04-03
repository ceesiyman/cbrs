<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            if ($request->hasFile('image')) {
                // Ensure directory exists
                if (!file_exists(public_path('projects'))) {
                    mkdir(public_path('projects'), 0755, true);
                }

                $image = $request->file('image');
                $filename = time() . '_' . auth()->id() . '.' . $image->getClientOriginalExtension();
                
                // Move the file to public/projects directory
                $image->move(public_path('projects'), $filename);
                
                // Store the path relative to public directory
                $validated['image'] = 'projects/' . $filename;
            }

            auth()->user()->projects()->create($validated);

            return redirect()->back()->with('success', 'Project added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding project: ' . $e->getMessage());
        }
    }
} 