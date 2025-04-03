<?php

namespace App\Http\Controllers;

use App\Models\Work;
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
            // Get works assigned to the constructor
            $assignedWorks = Work::where('constructor_id', $user->id)
                                ->latest()
                                ->get();
            
            // Get works where they are the client
            $clientWorks = Work::where('client_id', $user->id)
                              ->latest()
                              ->get();
        } else {
            // For clients, only get their posted works
            $assignedWorks = collect(); // Empty collection
            $clientWorks = Work::where('client_id', $user->id)
                              ->latest()
                              ->get();
        }

        return view('work.index', compact('assignedWorks', 'clientWorks'));
    }

    public function unassigned()
    {
        $works = Work::where('assigned', false)
            ->with(['client', 'skills', 'bids' => function($query) {
                $query->where('user_id', auth()->id());
            }])
            ->latest()
            ->get();

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

} 