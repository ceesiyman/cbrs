<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\User;
use App\Models\Skill;
use App\Models\WorkBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    public function create()
    {
        $skills = Skill::orderBy('name')->get();
        return view('work.create', compact('skills'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'total_cost' => 'required|numeric|min:0',
            'budget' => 'required|numeric|min:0',
            'skills' => 'required|array',
            'skills.*' => 'exists:skills,id'
        ]);

        $work = Work::create([
            'client_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'total_cost' => $validated['total_cost'],
            'budget' => $validated['budget'],
            'status' => 'pending'
        ]);

        $work->skills()->attach($validated['skills']);

        return redirect()->route('work.show', $work)
            ->with('success', 'Work project created successfully!');
    }

    public function show(Work $work)
    {
        return view('work.show', compact('work'));
    }

    public function index()
{
    $user = auth()->user();
    
    if ($user->isConstructor()) {
        // Get works assigned to the constructor (only accepted assignments)
        $assignedWorks = Work::where('constructor_id', $user->id)
                            ->where(function($query) {
                                $query->where('assigned', true)
                                      ->orWhere(function($q) {
                                          $q->where('is_hire_request', true)
                                            ->where('hire_status', 'accepted');
                                      });
                            })
                            ->latest()
                            ->get();
        
        // Get hire requests pending for this constructor
        $hireRequests = Work::where('constructor_id', $user->id)
                           ->where('is_hire_request', true)
                           ->where('hire_status', 'pending')
                           ->latest()
                           ->get();
        
        // Get works where they are the client
        $clientWorks = Work::where('client_id', $user->id)
                          ->latest()
                          ->get();
    } else {
        // For clients, only get their posted works
        $assignedWorks = collect(); // Empty collection
        $hireRequests = collect(); // Empty collection
        $clientWorks = Work::where('client_id', $user->id)
                          ->latest()
                          ->get();
    }

    return view('work.index', compact('assignedWorks', 'clientWorks', 'hireRequests'));
}

    public function unassigned(Request $request)
    {
        // Create the base query for unassigned works
        $query = Work::where('assigned', false)
                     ->where('status', '!=', 'completed')
                     ->with(['client', 'skills', 'bids']);
        
        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }
        
        // Apply skill filter
        if ($request->filled('skill')) {
            $skillId = $request->input('skill');
            $query->whereHas('skills', function($q) use ($skillId) {
                $q->where('skills.id', $skillId);
            });
        }
        
        // Apply budget filters
        if ($request->filled('min_budget')) {
            $query->where('budget', '>=', $request->input('min_budget'));
        }
        
        if ($request->filled('max_budget')) {
            $query->where('budget', '<=', $request->input('max_budget'));
        }
        
        // Apply sorting
        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case 'oldest':
                    $query->oldest();
                    break;
                case 'budget_high':
                    $query->orderByDesc('budget');
                    break;
                case 'budget_low':
                    $query->orderBy('budget');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }
        
        $works = $query->paginate(9)->withQueryString();
        
        return view('work.unassigned', compact('works'));
    }

    public function bid(Work $work)
    {
        // Add some debugging
        \Log::info('Bid method called for work: ' . $work->id);
        
        // Check if user is a constructor
        if (!auth()->user()->isConstructor()) {
            return redirect()->back()->with('error', 'Only constructors can bid on works');
        }

        // Check if work is already assigned
        if ($work->assigned) {
            return redirect()->back()->with('error', 'This work has already been assigned');
        }

        // Check if user has already bid on this work
        if ($work->bids()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'You have already placed a bid on this work');
        }

        return view('work.bid', compact('work'));
    }

    public function storeBid(Request $request, Work $work)
    {
        $validated = $request->validate([
            'bid_amount' => 'required|numeric|min:0'
        ]);

        // Check if user is a constructor
        if (!auth()->user()->isConstructor()) {
            return redirect()->back()->with('error', 'Only constructors can bid on works');
        }

        // Check if work is already assigned
        if ($work->assigned) {
            return redirect()->back()->with('error', 'This work has already been assigned');
        }

        // Check if user has already bid on this work
        if ($work->bids()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'You have already placed a bid on this work');
        }

        $work->bids()->create([
            'user_id' => auth()->id(),
            'bid_amount' => $validated['bid_amount'],
            'bid_status' => 'pending',
            'bid_date' => now()
        ]);

        return redirect()->route('work.show', $work)->with('success', 'Bid placed successfully!');
    }

    public function assign(Request $request, Work $work)
    {
        // Verify that the authenticated user is the work's client
        if (auth()->id() != $work->client_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Find the bid
        $bid = WorkBid::findOrFail($request->bid_id);

        // Update the work
        $work->update([
            'assigned' => true,
            'constructor_id' => $bid->user_id,
            'bid_by' => $bid->user_id
        ]);

        // Update the bid status
        $bid->update(['bid_status' => 'accepted']);

        // Reject all other bids
        WorkBid::where('work_id', $work->id)
               ->where('id', '!=', $bid->id)
               ->update(['bid_status' => 'rejected']);

        return redirect()->back()->with('success', 'Work has been assigned successfully!');
    }

    public function updateStatus(Request $request, Work $work)
    {
        // Verify that the authenticated user is the work's constructor
        if (auth()->id() != $work->constructor_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,in-progress,completed'
        ]);

        $work->update([
            'status' => $validated['status']
        ]);

        return redirect()->back()->with('success', 'Work status updated successfully!');
    }

    public function editBid(Work $work, WorkBid $bid)
    {
        // Check if the bid belongs to the authenticated user
        if ($bid->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Check if the bid is already accepted
        if ($bid->bid_status === 'accepted') {
            return redirect()->back()->with('error', 'Cannot update an accepted bid.');
        }

        return view('work.edit-bid', compact('work', 'bid'));
    }

    public function updateBid(Request $request, Work $work, WorkBid $bid)
    {
        // Check if the bid belongs to the authenticated user
        if ($bid->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Check if the bid is already accepted
        if ($bid->bid_status === 'accepted') {
            return redirect()->back()->with('error', 'Cannot update an accepted bid.');
        }

        $validated = $request->validate([
            'bid_amount' => 'required|numeric|min:0'
        ]);

        $bid->update([
            'bid_amount' => $validated['bid_amount'],
            'bid_date' => now() // Update the bid date to reflect the change
        ]);

        return redirect()->route('bids.index')->with('success', 'Bid updated successfully!');
    }

    public function recentWorks()
    {
        // Retrieve the most recent unassigned works
        $recentWorks = Work::where('assigned', false)
            ->latest() // Order by most recently created
            ->take(3) // Limit to 3 works
            ->with(['skills', 'bids']) // Eager load related skills and bids
            ->get()
            ->map(function ($work) {
                // Find the highest bid for this work
                $highestBid = $work->bids()->max('bid_amount');
                
                return [
                    'id' => $work->id,
                    'title' => $work->title,
                    'description' => Str::limit($work->description, 100), // Limit description length
                    'highest_bid' => $highestBid ?? 500, // Default to 500 if no bids
                    'icon' => $this->getWorkIcon($work) // Method to determine appropriate icon
                ];
            });
    
        return view('recent-works', compact('recentWorks'));
    }
    
    // Helper method to determine appropriate icon based on work type/skills
    private function getWorkIcon($work)
    {
        // Simple logic to assign icons based on skills or title
        $skills = $work->skills->pluck('name')->toArray();
        
        if (stripos($work->title, 'logo') !== false || in_array('design', $skills)) {
            return 'images/logo-design-icon.svg';
        }
        
        if (stripos($work->title, 'graphic') !== false || in_array('graphic design', $skills)) {
            return 'images/graphic-design-icon.svg';
        }
        
        if (stripos($work->title, 'seo') !== false || in_array('marketing', $skills)) {
            return 'images/seo-icon.svg';
        }
        
        // Default icon
        return 'images/default-work-icon.svg';
    }

    public function worksBySkill($skillId)
    {
        $skill = Skill::findOrFail($skillId);
        
        // Get works that have this skill
        $works = Work::whereHas('skills', function($query) use ($skillId) {
            $query->where('skills.id', $skillId);
        })->where('status', '!=', 'completed')
          ->where('assigned', false)
          ->latest()
          ->paginate(10);
        
        return view('work.by-skill', compact('works', 'skill'));
    }
    
 
    public function allSkills()
    {
        $skills = Skill::orderBy('name')->get();
        return view('skills.all', compact('skills'));
    }

    public function topWorks()
    {
        // Get completed works with their highest bid amounts
        $topWorks = Work::where('status', 'completed')
            ->where('assigned', true)
            ->with(['client', 'constructor', 'skills'])
            ->withCount('bids')
            ->withMax('bids', 'bid_amount')
            ->orderByDesc('bids_max_bid_amount')
            ->take(9)
            ->get();
            
        return view('works.top', compact('topWorks'));
    }

    public function showHireForm(User $constructor)
{
    // Get the authenticated client's unassigned works
    $unassignedWorks = Work::where('client_id', auth()->id())
                          ->where('assigned', false)
                          ->get();
    
    return view('work.hire-form', compact('constructor', 'unassignedWorks'));
}

public function sendHireRequest(Request $request, User $constructor)
{
    $request->validate([
        'work_id' => 'required|exists:works,id'
    ]);
    
    $work = Work::findOrFail($request->work_id);
    
    // Check if the work belongs to the authenticated user
    if ($work->client_id !== auth()->id()) {
        return back()->with('error', 'You can only assign your own works.');
    }
    
    // Check if the work is already assigned
    if ($work->assigned) {
        return back()->with('error', 'This work is already assigned.');
    }
    
    // Set hire request properties
    $work->update([
        'constructor_id' => $constructor->id,
        'is_hire_request' => true,
        'hire_status' => 'pending'
    ]);
    
    // Notification logic can be added here
    
    return redirect()->route('work.index')->with('success', 'Hire request sent successfully.');
}

public function respondToHireRequest(Request $request, Work $work)
{
    $request->validate([
        'response' => 'required|in:accept,decline'
    ]);
    
    if ($work->constructor_id !== auth()->id()) {
        return back()->with('error', 'This hire request is not for you.');
    }
    
    if ($request->response === 'accept') {
        $work->update([
            'assigned' => true,
            'hire_status' => 'accepted',
            'status' => 'in-progress' // or whatever initial status you prefer
        ]);
        
        return redirect()->route('work.index')->with('success', 'You have accepted the work.');
    } else {
        $work->update([
            'constructor_id' => null,
            'is_hire_request' => false,
            'hire_status' => 'declined'
        ]);
        
        return redirect()->route('work.index')->with('success', 'You have declined the work.');
    }
}

} 