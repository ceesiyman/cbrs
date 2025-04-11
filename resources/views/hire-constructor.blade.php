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
        margin-bottom: 2rem;
    }

    .search-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .search-input {
        flex-grow: 1;
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 1rem;
        outline: none;
    }

    .search-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }

    .filter-select {
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 1rem;
        outline: none;
    }

    .filter-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }

    .constructors-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .constructor-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        overflow: hidden;
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
        width: 100%;
        padding: 0.5rem 1rem;
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.15s;
    }

    .view-profile-btn:hover {
        background: #1d4ed8;
    }

    .pagination {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .pagination-nav {
        display: inline-flex;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .page-link {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        background: white;
        color: #374151;
        font-size: 0.875rem;
        text-decoration: none;
    }

    .page-link:hover {
        background: #f3f4f6;
    }

    .page-link:first-child {
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
    }

    .page-link:last-child {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
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

    @media (min-width: 640px) {
        .search-form {
            flex-direction: row;
        }

        .filter-select {
            width: auto;
        }
    }

    @media (min-width: 768px) {
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
        <div class="content-card">
            <div class="card-body">
                <h1 class="page-title">Hire a Constructor</h1>
                
                <!-- Search and Filter Section -->
                <div class="search-section">
                    <div class="search-form">
                        <input type="text" 
                               id="constructor-search"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search constructors by name" 
                               class="search-input">
                        <select name="specialty" id="specialty-filter" class="filter-select">
                            <option value="">Filter by specialty</option>
                            @foreach($skills as $skill)
                                <option value="{{ $skill->name }}" {{ request('specialty') == $skill->name ? 'selected' : '' }}>
                                    {{ $skill->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Loading and Error States -->
                <div id="search-loading" class="search-loading">Searching constructors...</div>
                <div id="search-error" class="search-error"></div>

                <!-- Constructors Grid -->
                <div id="constructors-grid" class="constructors-grid">
                    @forelse($constructors as $constructor)
                        <div class="constructor-card">
                            <div class="card-content">
                                <div class="profile-header">
                                <img src="{{ $constructor->image ?? asset('images/default-avatar.png') }}" 
                                     alt="{{ $constructor->username }}" 
                                     class="profile-image">
                                    <div class="profile-info">
                                        <h3 class="profile-name">{{ $constructor->username }}</h3>
                                        <p class="profile-role">{{ $constructor->skills->first() ? $constructor->skills->first()->name : 'Constructor' }}</p>
                                    </div>
                                </div>
                                
                                <p class="profile-description">
                                    {{ $constructor->experience->first() ? $constructor->experience->first()->description : 'Professional constructor available for hire.' }}
                                </p>
                                <div class="tags">
                                    @foreach($constructor->skills->take(3) as $skill)
                                        <span class="tag">{{ $skill->name }}</span>
                                    @endforeach
                                </div>
                                <a href="{{ route('constructor.profile', $constructor->id) }}" class="view-profile-btn">View Profile</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <p class="text-center text-gray-500">No constructors found matching your criteria.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div id="pagination" class="pagination">
                    {{ $constructors->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('constructor-search');
        const specialtyFilter = document.getElementById('specialty-filter');
        const constructorsGrid = document.getElementById('constructors-grid');
        const searchLoading = document.getElementById('search-loading');
        const searchError = document.getElementById('search-error');
        const pagination = document.getElementById('pagination');
        
        let searchTimeout = null;
        
        // Function to create constructor card
        function createConstructorCard(constructor) {
            return `
                <div class="constructor-card">
                    <div class="card-content">
                        <div class="profile-header">
                            <img src="${constructor.image || '/images/default-avatar.png'}" 
                                 alt="${constructor.username}" 
                                 class="profile-image">
                            <div class="profile-info">
                                <h3 class="profile-name">${constructor.username}</h3>
                                <p class="profile-role">Constructor</p>
                            </div>
                        </div>
                        
                        <p class="profile-description">
                            Professional constructor available for hire.
                        </p>
                        <div class="tags">
                                    @foreach($constructor->skills->take(3) as $skill)
                                        <span class="tag">{{ $skill->name }}</span>
                                    @endforeach
                                </div>
                        <a href="/constructors/${constructor.id}" class="view-profile-btn">View Profile</a>
                    </div>
                </div>
            `;
        }
        
        // Function to search constructors
        async function searchConstructors(query) {
            searchLoading.style.display = 'block';
            searchError.style.display = 'none';
            
            try {
                const response = await fetch(`/api/search-constructors?query=${encodeURIComponent(query)}`);
                
                if (!response.ok) {
                    throw new Error('Failed to search constructors');
                }
                
                const constructors = await response.json();
                
                constructorsGrid.innerHTML = '';
                pagination.style.display = 'none';
                
                if (constructors.length === 0) {
                    constructorsGrid.innerHTML = `
                        <div class="col-span-full">
                            <p class="text-center text-gray-500">No constructors found matching your search.</p>
                        </div>
                    `;
                } else {
                    constructors.forEach(constructor => {
                        constructorsGrid.innerHTML += createConstructorCard(constructor);
                    });
                }
            } catch (error) {
                searchError.textContent = 'An error occurred while searching. Please try again.';
                searchError.style.display = 'block';
                console.error('Search error:', error);
            } finally {
                searchLoading.style.display = 'none';
            }
        }
        
        // Initialize search input event listener
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.trim();
            
            // Clear any existing timeout
            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }
            
            // If search query is empty, reload the page to show default constructors
            if (query === '') {
                const currentUrl = new URL(window.location);
                currentUrl.searchParams.delete('search');
                window.location.href = currentUrl.href;
                return;
            }
            
            // Set a timeout to avoid making too many requests
            searchTimeout = setTimeout(() => {
                searchConstructors(query);
            }, 300);
        });
        
        // Initialize specialty filter event listener
        specialtyFilter.addEventListener('change', function() {
            const specialty = this.value;
            const currentUrl = new URL(window.location);
            
            if (specialty) {
                currentUrl.searchParams.set('specialty', specialty);
            } else {
                currentUrl.searchParams.delete('specialty');
            }
            
            window.location.href = currentUrl.href;
        });
    });
</script>
@endsection