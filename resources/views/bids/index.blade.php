@extends('layouts.app')

@section('content')
<style>
    .bids-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .bids-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .bids-title {
        font-size: 1.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .bids-subtitle {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .bids-grid {
        display: grid;
        gap: 1.5rem;
    }

    .bid-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        border: 1px solid #e5e7eb;
    }

    .bid-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .work-title {
        font-size: 1.25rem;
        font-weight: 500;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .bid-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .bid-amount {
        font-weight: 600;
        color: #0ea5e9;
        font-size: 1.125rem;
    }

    .bid-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .bid-status {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .work-meta-dot {
        width: 3px;
        height: 3px;
        background-color: #d1d5db;
        border-radius: 50%;
    }

    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status-accepted {
        background-color: #dcfce7;
        color: #166534;
    }

    .status-rejected {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
    }

    .empty-state-text {
        color: #6b7280;
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        .bids-container {
            margin: 1rem auto;
        }

        .bids-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 640px) {
        .bid-header {
            flex-direction: column;
            gap: 1rem;
        }

        .bid-actions {
            width: 100%;
            justify-content: space-between;
        }
    }

    .update-bid-btn {
        padding: 0.375rem 0.75rem;
        background-color: #0ea5e9;
        color: white;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.2s;
    }

    .update-bid-btn:hover {
        background-color: #0284c7;
    }
</style>

<div class="bids-container">
    <div class="bids-header">
        <h1 class="bids-title">My Bids</h1>
        <p class="bids-subtitle">Track all your work bids and their statuses</p>
    </div>

    @if($bids->isEmpty())
        <div class="empty-state">
            <p class="empty-state-text">You haven't placed any bids yet.</p>
            <a href="{{ route('work.unassigned') }}" class="post-project-btn">Browse Available Works</a>
        </div>
    @else
        <div class="bids-grid">
            @foreach($bids as $bid)
                <div class="bid-card">
                    <div class="bid-header">
                        <div>
                            <h3 class="work-title">
                                <a href="{{ route('work.show', $bid->work) }}" class="hover:text-blue-500">
                                    {{ $bid->work->title }}
                                </a>
                            </h3>
                            <div class="bid-meta">
                                Bid placed {{ $bid->bid_date->diffForHumans() }}
                                <span class="work-meta-dot"></span>
                                Client: {{ $bid->work->client->username }}
                            </div>
                        </div>
                        <div class="bid-actions">
                            <div class="bid-amount">${{ number_format($bid->bid_amount, 2) }}</div>
                            <span class="bid-status status-{{ $bid->bid_status }}">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor">
                                    <circle cx="6" cy="6" r="5" stroke-width="2"/>
                                </svg>
                                {{ ucfirst($bid->bid_status) }}
                            </span>
                            @if($bid->bid_status !== 'accepted')
                                <a href="{{ route('work.bid.edit', ['work' => $bid->work, 'bid' => $bid]) }}" 
                                   class="update-bid-btn">
                                    Update Bid
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 