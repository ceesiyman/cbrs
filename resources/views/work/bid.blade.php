@extends('layouts.app')

@section('content')
<style>
    .bid-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .work-details {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        border: 1px solid #e5e7eb;
    }

    .work-title {
        font-size: 1.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .work-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 2rem;
    }

    .work-meta-dot {
        width: 3px;
        height: 3px;
        background-color: #d1d5db;
        border-radius: 50%;
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

    .bid-form-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        border: 1px solid #e5e7eb;
        position: sticky;
        top: 2rem;
    }

    .bid-form-title {
        font-size: 1.25rem;
        font-weight: 500;
        color: #1f2937;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 0.875rem;
        color: #1f2937;
        transition: border-color 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }

    .budget-info {
        background-color: #f8fafc;
        border-radius: 6px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .budget-label {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }

    .budget-amount {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
    }

    .submit-bid-btn {
        width: 100%;
        padding: 0.75rem;
        background-color: #0ea5e9;
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .submit-bid-btn:hover {
        background-color: #0284c7;
    }

    .error-message {
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    @media (max-width: 768px) {
        .bid-container {
            grid-template-columns: 1fr;
        }

        .bid-form-container {
            position: static;
        }
    }
</style>

<div class="bid-container">
    <div class="work-details">
        <h1 class="work-title">{{ $work->title }}</h1>
        <div class="work-meta">
            Posted {{ $work->created_at->diffForHumans() }}
            <span class="work-meta-dot"></span>
            by {{ $work->client->username }}
        </div>

        <div class="work-section">
            <h2 class="section-title">Project Description</h2>
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
    </div>

    <div class="bid-form-container">
        <h2 class="bid-form-title">Place Your Bid</h2>
        
        <div class="budget-info">
            <div class="budget-label">Client's Budget</div>
            <div class="budget-amount">${{ number_format($work->budget) }}</div>
        </div>

        <form action="{{ route('work.bid.store', $work) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="bid_amount" class="form-label">Your Bid Amount</label>
                <input type="number" 
                       id="bid_amount" 
                       name="bid_amount" 
                       class="form-input" 
                       step="0.01" 
                       min="0" 
                       value="{{ old('bid_amount') }}"
                       required>
                @error('bid_amount')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="submit-bid-btn">Submit Bid</button>
        </form>
    </div>
</div>
@endsection 