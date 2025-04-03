<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Skill;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $allSkills = Skill::orderBy('name')->get();
        return view('profile.show', compact('user', 'allSkills'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
            
            // Generate unique filename
            $filename = time() . '_' . $user->id . '.' . $request->image->extension();
            
            // Move the file to public/profile-photo directory
            $request->image->move(public_path('profile-photo'), $filename);
            
            // Store the relative path in the database
            $validated['image'] = '/profile-photo/' . $filename;
        }

        $user->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully!');
    }
} 