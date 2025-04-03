@extends('layouts.app')

@section('content')
<style>
    .work-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .work-card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }

    .work-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .work-title {
        font-size: 1.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .work-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        color: #6b7280;
        font-size: 0.875rem;
    }

    .work-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .work-section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 1rem;
    }

    .work-description {
        color: #4b5563;
        line-height: 1.6;
    }

    .skills-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .skill-tag {
        background-color: #f1f5f9;
        color: #475569;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.875rem;
    }

    .work-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .detail-item {
        background-color: #f8fafc;
        padding: 1rem;
        border-radius: 6px;
    }

    .detail-label {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }

    .detail-value {
        font-size: 1rem;
        color: #1f2937;
        font-weight: 500;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
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

    .status-cancelled {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .bids-section {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #f1f5f9;
    }

    .bids-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 1.5rem;
    }

    .bids-grid {
        display: grid;
        gap: 1rem;
    }

    .bid-card {
        background: white;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        padding: 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .bid-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .bidder-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        color: #475569;
    }

    .bidder-details {
        display: flex;
        flex-direction: column;
    }

    .bidder-name {
        font-weight: 500;
        color: #1f2937;
    }

    .bid-date {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .bid-amount {
        font-weight: 600;
        color: #0ea5e9;
        font-size: 1.125rem;
    }

    .bid-status {
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .bid-status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .bid-status-accepted {
        background-color: #dcfce7;
        color: #166534;
    }

    .bid-status-rejected {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .no-bids {
        text-align: center;
        padding: 2rem;
        background: #f8fafc;
        border-radius: 8px;
        color: #6b7280;
    }

    .bid-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .assign-button {
        padding: 0.375rem 0.75rem;
        background-color: #0ea5e9;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .assign-button:hover {
        background-color: #0284c7;
    }

    .assign-button:disabled {
        background-color: #e5e7eb;
        cursor: not-allowed;
    }

    .bidder-link {
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .bidder-link:hover .bidder-name {
        color: #0ea5e9;
    }

    @media (max-width: 640px) {
        .work-container {
            margin: 1rem auto;
        }

        .work-card {
            padding: 1.5rem;
        }

        .work-title {
            font-size: 1.5rem;
        }

        .work-details {
            grid-template-columns: 1fr;
        }

        .bid-card {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
    }

    .modal-backdrop {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 50;
        align-items: center;
        justify-content: center;
    }

    .modal-backdrop.show {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 500px;
        padding: 2rem;
        transform: translateY(-20px);
        transition: transform 0.3s ease-out;
    }

    .modal-backdrop.show .modal-content {
        transform: translateY(0);
    }

    .modal-header {
        margin-bottom: 1.5rem;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
    }

    .modal-body {
        margin-bottom: 2rem;
        color: #4b5563;
        line-height: 1.5;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .modal-button {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .modal-confirm {
        background-color: #0ea5e9;
        color: white;
        border: none;
    }

    .modal-confirm:hover {
        background-color: #0284c7;
    }

    .modal-cancel {
        background-color: #f3f4f6;
        color: #4b5563;
        border: 1px solid #e5e7eb;
    }

    .modal-cancel:hover {
        background-color: #e5e7eb;
    }

    .bid-highlight {
        background-color: #f8fafc;
        padding: 1rem;
        border-radius: 6px;
        margin: 1rem 0;
    }

    .bid-highlight-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    .bid-highlight-label {
        color: #6b7280;
    }

    .bid-highlight-value {
        font-weight: 500;
        color: #1f2937;
    }
</style>

<div class="work-container">
    <div class="work-card">
        <div class="work-header">
            <h1 class="work-title">{{ $work->title }}</h1>
            <div class="work-meta">
                <div class="work-meta-item">
                    <span>Status:</span>
                    <span class="status-badge status-{{ strtolower($work->status) }}">
                        {{ ucfirst($work->status) }}
                    </span>
                </div>
                <div class="work-meta-item">
                    <span>Created:</span>
                    <span>{{ $work->created_at->format('M d, Y') }}</span>
                </div>
                @if($work->constructor)
                    <div class="work-meta-item">
                        <span>Constructor:</span>
                        <span>{{ $work->constructor->name }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="work-section">
            <h2 class="section-title">Description</h2>
            <div class="work-description">
                {{ $work->description }}
            </div>
        </div>

        <div class="work-section">
            <h2 class="section-title">Required Skills</h2>
            <div class="skills-list">
                @foreach($work->skills as $skill)
                    <span class="skill-tag">{{ $skill->name }}</span>
                @endforeach
            </div>
        </div>

        <div class="work-section">
            <h2 class="section-title">Project Details</h2>
            <div class="work-details">
                <div class="detail-item">
                    <div class="detail-label">Start Date</div>
                    <div class="detail-value">{{ $work->start_date->format('M d, Y') }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Total Cost</div>
                    <div class="detail-value">${{ number_format($work->total_cost, 2) }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Budget</div>
                    <div class="detail-value">${{ number_format($work->budget, 2) }}</div>
                </div>
                @if($work->bid_by)
                    <div class="detail-item">
                        <div class="detail-label">Bid By</div>
                        <div class="detail-value">{{ $work->bidBy->name }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="bids-section">
        <h2 class="bids-title">Bids ({{ $work->bids->count() }})</h2>
        
        @if($work->bids->isEmpty())
            <div class="no-bids">
                No bids have been placed on this work yet.
            </div>
        @else
            <div class="bids-grid">
                @foreach($work->bids as $bid)
                    <div class="bid-card">
                        <div class="bid-info">
                            <a href="{{ route('constructor.profile', $bid->user->id) }}" class="bidder-link">
                                <div class="bidder-avatar">
                                    {{ strtoupper(substr($bid->user->username, 0, 1)) }}
                                </div>
                                <div class="bidder-details">
                                    <span class="bidder-name">{{ $bid->user->username }}</span>
                                    <span class="bid-date">{{ $bid->bid_date->diffForHumans() }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="bid-actions">
                            <div class="bid-amount">${{ number_format($bid->bid_amount, 2) }}</div>
                            <span class="bid-status bid-status-{{ $bid->bid_status }}">
                                {{ ucfirst($bid->bid_status) }}
                            </span>
                            @if(auth()->id() == $work->client_id && !$work->assigned)
                                <button type="button" 
                                        class="assign-button"
                                        onclick="showAssignModal(
                                            '{{ $bid->id }}', 
                                            '{{ $bid->user->username }}', 
                                            '{{ $bid->bid_amount }}',
                                            '{{ $work->id }}'
                                        )">
                                    Assign Work
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div id="assignModal" class="modal-backdrop">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Confirm Work Assignment</h3>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to assign this work to <span id="bidderName" class="font-semibold"></span>?</p>
            
            <div class="bid-highlight">
                <div class="bid-highlight-item">
                    <span class="bid-highlight-label">Work Title:</span>
                    <span class="bid-highlight-value">{{ $work->title }}</span>
                </div>
                <div class="bid-highlight-item">
                    <span class="bid-highlight-label">Bid Amount:</span>
                    <span class="bid-highlight-value" id="bidAmount"></span>
                </div>
            </div>
            
            <p>This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-button modal-cancel" onclick="closeModal()">Cancel</button>
            <form id="assignForm" method="POST" class="inline">
                @csrf
                <input type="hidden" name="bid_id" id="bidId">
                <button type="submit" class="modal-button modal-confirm">Confirm Assignment</button>
            </form>
        </div>
    </div>
</div>

<script>
    function showAssignModal(bidId, bidderName, bidAmount, workId) {
        document.getElementById('bidId').value = bidId;
        document.getElementById('bidderName').textContent = bidderName;
        document.getElementById('bidAmount').textContent = '$' + parseFloat(bidAmount).toLocaleString('en-US', {minimumFractionDigits: 2});
        document.getElementById('assignForm').action = `/work/${workId}/assign`;
        document.getElementById('assignModal').classList.add('show');
    }

    function closeModal() {
        document.getElementById('assignModal').classList.remove('show');
    }

    // Close modal when clicking outside
    document.getElementById('assignModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endsection 