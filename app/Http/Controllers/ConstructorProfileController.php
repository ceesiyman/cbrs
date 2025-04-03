<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ConstructorProfileController extends Controller
{
    public function show($id)
    {
        $constructor = User::where('role', 'Constructor')
            ->with(['skills', 'experience', 'projects'])
            ->findOrFail($id);

        return view('constructor-profile', compact('constructor'));
    }
} 