<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BidController extends Controller
{
    public function index()
    {
        // Get all bids for the authenticated constructor
        $bids = auth()->user()->bids()
            ->with(['work.client'])
            ->orderBy('bid_date', 'desc')
            ->get();

        return view('bids.index', compact('bids'));
    }
} 