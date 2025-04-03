@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-semibold mb-4">Welcome, {{ Auth::user()->username }}!</h1>
                
                <div class="mb-4">
                    <p class="text-gray-600">Role: {{ Auth::user()->role }}</p>
                    <p class="text-gray-600">Email: {{ Auth::user()->email }}</p>
                    <p class="text-gray-600">Phone: {{ Auth::user()->phone_number }}</p>
                </div>

                @if(Auth::user()->role === 'Constructor')
                    <div class="mt-6">
                        <h2 class="text-xl font-semibold mb-4">Constructor Dashboard</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <a href="#" class="p-4 bg-blue-50 rounded-lg hover:bg-blue-100">
                                <h3 class="font-semibold">My Projects</h3>
                                <p class="text-sm text-gray-600">View and manage your construction projects</p>
                            </a>
                            <a href="#" class="p-4 bg-green-50 rounded-lg hover:bg-green-100">
                                <h3 class="font-semibold">Available Projects</h3>
                                <p class="text-sm text-gray-600">Browse and bid on new projects</p>
                            </a>
                            <a href="#" class="p-4 bg-purple-50 rounded-lg hover:bg-purple-100">
                                <h3 class="font-semibold">Profile Settings</h3>
                                <p class="text-sm text-gray-600">Update your profile and preferences</p>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="mt-6">
                        <h2 class="text-xl font-semibold mb-4">Client Dashboard</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <a href="#" class="p-4 bg-blue-50 rounded-lg hover:bg-blue-100">
                                <h3 class="font-semibold">My Projects</h3>
                                <p class="text-sm text-gray-600">View and manage your construction projects</p>
                            </a>
                            <a href="#" class="p-4 bg-green-50 rounded-lg hover:bg-green-100">
                                <h3 class="font-semibold">Post New Project</h3>
                                <p class="text-sm text-gray-600">Create a new construction project</p>
                            </a>
                            <a href="#" class="p-4 bg-purple-50 rounded-lg hover:bg-purple-100">
                                <h3 class="font-semibold">Profile Settings</h3>
                                <p class="text-sm text-gray-600">Update your profile and preferences</p>
                            </a>
                        </div>
                    </div>
                @endif

                <div class="mt-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 