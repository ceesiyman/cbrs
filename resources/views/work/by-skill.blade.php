{{-- works/by-skill.blade.php --}}

@extends('layouts.app')

@section('content')
<section class="categories-section">
    <div class="categories-container">
        <h2 class="categories-title">Works Requiring <span>{{ $skill->name }}</span></h2>
        
        @if($works->count() > 0)
            <div class="works-grid">
                @foreach($works as $work)
                <div class="work-card">
                    <div class="work-content">
                        <h3 class="work-title">{{ $work->title }}</h3>
                        <p class="work-description">{{ Str::limit($work->description, 100) }}</p>
                        
                        <div class="work-details">
                            <div class="work-date">
                                <svg xmlns="http://www.w3.org/2000/svg" class="work-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ $work->start_date->format('M d, Y') }}</span>
                            </div>
                            <div class="work-budget">Tsh {{ number_format($work->budget) }}</div>
                        </div>
                        
                        <div class="work-skills">
                            @foreach($work->skills as $workSkill)
                                <span class="work-skill-tag">{{ $workSkill->name }}</span>
                            @endforeach
                        </div>
                        
                        <a href="{{ route('work.bid', $work->id) }}" class="work-details-btn">
                            Apply Now
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="pagination-container">
                {{ $works->links() }}
            </div>
        @else
            <div class="no-works-container">
                <h3 class="no-works-title">No Works Available</h3>
                <p class="no-works-message">There are currently no open projects requiring "{{ $skill->name }}" skills.</p>
                <a href="{{ url()->previous() }}" class="more-categories-btn">
                    Go Back
                </a>
            </div>
        @endif
    </div>
</section>

<style>
    /* Base styles from the original template */
    .categories-section {
        padding: 4rem 2rem;
        background-color: #f8fafc;
    }

    .categories-container {
        max-width: 1280px;
        margin: 0 auto;
    }

    .categories-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 3rem;
    }

    .categories-title span {
        color: #2563eb;
    }
    
    .more-categories-btn {
        display: inline-block;
        padding: 0.875rem 2rem;
        background-color: #2563eb;
        color: white;
        font-weight: 500;
        border-radius: 0.5rem;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .more-categories-btn:hover {
        background-color: #1d4ed8;
    }

    /* Works grid styling */
    .works-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .work-card {
        background-color: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .work-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .work-content {
        padding: 1.5rem;
    }

    .work-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.75rem;
    }

    .work-description {
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    .work-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .work-date {
        display: flex;
        align-items: center;
        color: #4b5563;
        font-size: 0.875rem;
    }

    .work-icon {
        width: 1rem;
        height: 1rem;
        margin-right: 0.375rem;
    }

    .work-budget {
        font-weight: 600;
        color: #047857;
    }

    .work-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.25rem;
    }

    .work-skill-tag {
        background-color: #dbeafe;
        color: #1e40af;
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
    }

    .work-details-btn {
        display: block;
        width: 100%;
        text-align: center;
        padding: 0.75rem 0;
        background-color: #2563eb;
        color: white;
        font-weight: 500;
        border-radius: 0.5rem;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .work-details-btn:hover {
        background-color: #1d4ed8;
    }

    .pagination-container {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .no-works-container {
        background-color: #fefce8;
        border: 1px solid #fef3c7;
        border-radius: 1rem;
        padding: 3rem 1.5rem;
        text-align: center;
    }

    .no-works-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #92400e;
        margin-bottom: 0.75rem;
    }

    .no-works-message {
        color: #b45309;
        margin-bottom: 1.5rem;
    }

    @media (max-width: 1024px) {
        .works-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .works-grid {
            grid-template-columns: 1fr;
        }

        .categories-title {
            font-size: 2rem;
        }
    }
</style>
@endsection