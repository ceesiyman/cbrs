@extends('layouts.app')

@section('content')
<style>
    .works-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .works-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .works-title {
        font-size: 1.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .works-subtitle {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .works-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .work-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        transition: all 0.2s;
        cursor: pointer;
        position: relative;
        border: 1px solid #e5e7eb;
    }

    .work-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-color: #0ea5e9;
    }

    .work-card-link {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }

    .work-title {
        font-size: 1.25rem;
        font-weight: 500;
        color: #1f2937;
        margin-bottom: 0.75rem;
    }

    .work-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .work-meta-dot {
        width: 3px;
        height: 3px;
        background-color: #d1d5db;
        border-radius: 50%;
    }

    .work-description {
        color: #4b5563;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .work-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
    }

    .work-status {
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status-in-progress {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .status-completed {
        background-color: #dcfce7;
        color: #166534;
    }

    .work-budget {
        font-weight: 500;
        color: #1f2937;
        font-size: 0.95rem;
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
        font-size: 0.95rem;
    }

    .bid-status {
        margin-top: 0.5rem;
        padding: 0.25rem 0.5rem;
        background-color: #e0f2fe;
        color: #0369a1;
        border-radius: 4px;
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .works-container {
            margin: 1rem auto;
        }

        .works-header {
            margin-bottom: 1.5rem;
        }

        .works-title {
            font-size: 1.5rem;
        }

        .works-grid {
            grid-template-columns: 1fr;
        }

        .work-card {
            padding: 1.25rem;
        }
    }
</style>

<div class="works-container">
    <div class="works-header">
        <h1 class="works-title">Available Works</h1>
        <p class="works-subtitle">
            Browse and bid on open construction projects
        </p>
    </div>

    @if($works->isEmpty())
        <div class="empty-state">
            <p class="empty-state-text">No available works found at the moment.</p>
            @if(auth()->user()->isClient())
                <a href="{{ route('work.create') }}" class="post-project-btn">Post a new project</a>
            @endif
        </div>
    @else
        <div class="works-grid">
            @foreach($works as $work)
                @php
                    $hasBid = $work->bids->where('constructor_id', auth()->id())->first();
                @endphp
                <div class="work-card" onclick="navigateToWork({{ $work->id }}, '{{ auth()->user()->isConstructor() ? ($hasBid ? 'edit-bid' : 'bid') : 'show' }}', {{ $hasBid ? $hasBid->id : 'null' }})">
                    <h2 class="work-title">{{ $work->title }}</h2>
                    <div class="work-meta">
                        Posted {{ $work->created_at->diffForHumans() }}
                        <span class="work-meta-dot"></span>
                        by {{ $work->client->username }}
                    </div>
                    <div class="work-description">
                        {{ $work->description }}
                    </div>
                    <div class="work-footer">
                        <span class="work-status status-{{ strtolower($work->status) }}">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor">
                                <circle cx="6" cy="6" r="5" stroke-width="2"/>
                            </svg>
                            {{ ucfirst($work->status) }}
                        </span>
                        <span class="work-budget">
                            Budget: ${{ number_format($work->budget) }}
                        </span>
                    </div>
                    @if($hasBid)
                        <div class="bid-status">You have already bid on this work</div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
function navigateToWork(workId, action, bidId = null) {
    if (action === 'bid') {
        window.location.href = `/work/${workId}/bid`;
    } else if (action === 'edit-bid') {
        window.location.href = `/work/${workId}/bid/${bidId}/edit`;
    } else {
        window.location.href = `/work/${workId}`;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.work-card');
    cards.forEach(card => {
        card.style.cursor = 'pointer';
    });
});
</script>
@endsection 