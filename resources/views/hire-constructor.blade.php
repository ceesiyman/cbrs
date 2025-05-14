@extends('layouts.app')

@section('content')
<style>
    .page-container {
        padding: 3rem 1rem;
    }

    .content-wrapper {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .content-card {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-body {
        padding: 1.5rem;
    }

    .page-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.5rem;
    }

    .search-section {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid #e5e7eb;
    }

    .search-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .search-form {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }

    .search-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .search-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #4b5563;
    }

    .search-input {
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        outline: none;
        font-size: 0.95rem;
    }

    .search-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
    }

    .filter-select {
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        outline: none;
        font-size: 0.95rem;
    }

    .filter-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
    }

    .search-buttons {
        display: flex;
        justify-content: flex-end;
        margin-top: 1rem;
        gap: 0.75rem;
    }

    .search-reset, .search-apply {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
    }

    .search-reset {
        background-color: white;
        border: 1px solid #d1d5db;
        color: #4b5563;
    }

    .search-apply {
        background-color: #2563eb;
        border: 1px solid #2563eb;
        color: white;
    }

    .search-reset:hover {
        background-color: #f9fafb;
    }

    .search-apply:hover {
        background-color: #1d4ed8;
    }

    .constructors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .constructor-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.2s;
    }

    .constructor-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-color: #0ea5e9;
    }

    .card-content {
        padding: 1.5rem;
    }

    .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .profile-image {
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        object-fit: cover;
    }

    .profile-info {
        margin-left: 1rem;
    }

    .profile-name {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
    }

    .profile-role {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .rating {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .star-icon {
        width: 1.25rem;
        height: 1.25rem;
        color: #fbbf24;
    }

    .rating-text {
        margin-left: 0.25rem;
    }

    .profile-description {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .tag {
        padding: 0.25rem 0.75rem;
        background: #dbeafe;
        color: #1e40af;
        font-size: 0.75rem;
        border-radius: 9999px;
    }

    .view-profile-btn {
        display: block;
        width: 100%;
        padding: 0.5rem 1rem;
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.15s;
        text-decoration: none;
    }

    .view-profile-btn:hover {
        background: #1d4ed8;
    }

    .pagination {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .search-loading {
        text-align: center;
        padding: 1rem;
        display: none;
    }

    .search-error {
        color: #ef4444;
        text-align: center;
        padding: 1rem;
        display: none;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
        margin-bottom: 2rem;
    }

    .empty-state-text {
        color: #6b7280;
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .experience-badge {
        background-color: #f0fdf4;
        color: #166534;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        margin-top: 0.5rem;
        display: inline-block;
    }

    @media (max-width: 640px) {
        .search-form {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .constructors-grid {
            grid-template-columns: repeat(1, 1fr);
        }
    }

    @media (min-width: 769px) and (max-width: 1023px) {
        .constructors-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .constructors-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>

<div class="page-container">
    <div class="content-wrapper">
        <h1 class="page-title">Hire a Constructor</h1>
        
        <!-- Search and Filter Section -->
        <div class="search-section">
            <h2 class="search-title">Find Constructors</h2>
            <form action="{{ route('constructors.index') }}" method="get" class="search-form">
                <div class="search-group">
                    <label for="search" class="search-label">Search Constructors</label>
                    <input type="text" 
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Constructor name or username" 
                           class="search-input">
                </div>
                
                <div class="search-group">
                    <label for="specialty" class="search-label">Specialty</label>
                    <select name="specialty" id="specialty" class="filter-select">
                        <option value="">All Specialties</option>
                        @foreach($skills as $skill)
                            <option value="{{ $skill->name }}" {{ request('specialty') == $skill->name ? 'selected' : '' }}>
                                {{ $skill->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="search-group">
                    <label for="location" class="search-label">Location</label>
                    <select name="location" id="location" class="filter-select">
                        <option value="">Any Location</option>
                        <option value="Dar es Salaam" {{ request('location') == 'Dar es Salaam' ? 'selected' : '' }}>Dar es Salaam</option>
                        <option value="Dodoma" {{ request('location') == 'Dodoma' ? 'selected' : '' }}>Dodoma</option>
                        <option value="Arusha" {{ request('location') == 'Arusha' ? 'selected' : '' }}>Arusha</option>
                        <option value="Mwanza" {{ request('location') == 'Mwanza' ? 'selected' : '' }}>Mwanza</option>
                        <option value="Zanzibar" {{ request('location') == 'Zanzibar' ? 'selected' : '' }}>Zanzibar</option>
                    </select>
                </div>
                
                <div class="search-group">
                    <label for="experience" class="search-label">Experience</label>
                    <select name="experience" id="experience" class="filter-select">
                        <option value="">Any Experience</option>
                        <option value="1" {{ request('experience') == '1' ? 'selected' : '' }}>1+ years</option>
                        <option value="2" {{ request('experience') == '2' ? 'selected' : '' }}>2+ years</option>
                        <option value="5" {{ request('experience') == '5' ? 'selected' : '' }}>5+ years</option>
                        <option value="10" {{ request('experience') == '10' ? 'selected' : '' }}>10+ years</option>
                    </select>
                </div>
                
                <div class="search-buttons">
                    <a href="{{ route('constructors.index') }}" class="search-reset">Reset</a>
                    <button type="submit" class="search-apply">Find Constructors</button>
                </div>
            </form>
        </div>

        <!-- Loading and Error States -->
        <div id="search-loading" class="search-loading">Searching constructors...</div>
        <div id="search-error" class="search-error"></div>

        <!-- Constructors Grid -->
        @if($constructors->isEmpty())
            <div class="empty-state">
                <p class="empty-state-text">No constructors found matching your criteria.</p>
                <p>Try adjusting your search filters or browse all constructors.</p>
            </div>
        @else
            <div id="constructors-grid" class="constructors-grid">
                @foreach($constructors as $constructor)
                    <div class="constructor-card">
                        <div class="card-content">
                            <div class="profile-header">
                                <img src="{{ $constructor->image ?? asset('images/default-avatar.png') }}" 
                                     alt="{{ $constructor->username }}" 
                                     class="profile-image"
                                     onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                                <div class="profile-info">
                                    <h3 class="profile-name">{{ $constructor->username }}</h3>
                                    <p class="profile-role">{{ $constructor->skills->first() ? $constructor->skills->first()->name : 'Constructor' }}</p>
                                    @if($constructor->experience && $constructor->experience->count() > 0)
                                        <span class="experience-badge">{{ $constructor->experience->count() }}+ years experience</span>
                                    @endif
                                </div>
                            </div>
                            
                            <p class="profile-description">
                                {{ $constructor->experience->first() ? $constructor->experience->first()->description : 'Professional constructor available for hire.' }}
                            </p>
                            
                            <div class="tags">
                                @foreach($constructor->skills->take(3) as $skill)
                                    <span class="tag">{{ $skill->name }}</span>
                                @endforeach
                                @if($constructor->skills->count() > 3)
                                    <span class="tag">+{{ $constructor->skills->count() - 3 }} more</span>
                                @endif
                            </div>
                            
                            <a href="{{ route('constructor.profile', $constructor->id) }}" class="view-profile-btn">View Profile</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div id="pagination" class="pagination">
                {{ $constructors->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection