<!DOCTYPE html>
<style>
    .nav-container {
        background-color: #f8fafc;
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .logo {
        height: 60px;
        width: auto;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .nav-link {
        text-decoration: none;
        color: #64748b;
        font-size: 0.95rem;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .nav-link:hover {
        color: #0ea5e9;
    }

    .post-project-btn {
        background-color: #0ea5e9;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.95rem;
        transition: background-color 0.2s;
    }

    .post-project-btn:hover {
        background-color: #0284c7;
    }

    .mobile-menu-btn {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
    }

    .mobile-menu-btn svg {
        color: #64748b;
    }

    .mobile-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: #f8fafc;
        padding: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        z-index: 50;
    }

    .mobile-menu .nav-link {
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .mobile-menu .nav-link:last-child {
        border-bottom: none;
    }

    .mobile-menu .post-project-btn {
        display: block;
        text-align: center;
        margin-top: 1rem;
    }

    .logout-btn {
        background: none;
        border: none;
        color: #64748b;
        font-size: 0.95rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0;
        transition: color 0.2s;
        width: 100%;
        text-align: left;
    }

    .logout-btn:hover {
        color: #0ea5e9;
    }

    .logout-icon {
        width: 18px;
        height: 18px;
    }

    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .mobile-menu-btn {
            display: block;
        }

        .mobile-menu.show {
            display: block;
        }

        .mobile-menu .nav-links {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 0;
        }
    }

    .search-popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 100;
        padding: 1rem;
    }

    .search-popup.show {
        display: flex;
        align-items: flex-start;
        justify-content: center;
    }

    .search-container {
        background-color: white;
        border-radius: 8px;
        width: 100%;
        max-width: 600px;
        margin-top: 6rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .search-header {
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
    }

    .close-btn {
        background: none;
        border: none;
        color: #64748b;
        cursor: pointer;
        padding: 0.5rem;
    }

    .close-btn:hover {
        color: #0ea5e9;
    }

    .search-form {
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        font-size: 1rem;
        color: #374151;
        transition: border-color 0.2s;
    }

    .search-input:focus {
        outline: none;
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }

    .search-results {
        max-height: 400px;
        overflow-y: auto;
    }

    .constructor-card {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: background-color 0.2s;
    }

    .constructor-card:hover {
        background-color: #f8fafc;
    }

    .constructor-image {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
    }

    .constructor-info {
        flex: 1;
    }

    .constructor-name {
        font-weight: 500;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }

    .constructor-details {
        font-size: 0.875rem;
        color: #64748b;
    }

    .view-profile-btn {
        padding: 0.5rem 1rem;
        background-color: #0ea5e9;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .view-profile-btn:hover {
        background-color: #0284c7;
    }

    .no-results {
        padding: 2rem;
        text-align: center;
        color: #64748b;
    }

    .loading {
        padding: 2rem;
        text-align: center;
        color: #64748b;
    }

    .error-message {
        color: #dc2626;
        text-align: center;
        padding: 1rem;
        font-size: 0.875rem;
    }

    .loading-spinner {
        display: inline-block;
        width: 1.5rem;
        height: 1.5rem;
        border: 2px solid #e5e7eb;
        border-top-color: #0ea5e9;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-right: 0.5rem;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .header-profile-dropdown {
        position: relative;
        display: inline-block;
        z-index: 60;
    }

    .header-profile-button {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem;
        border-radius: 9999px;
        transition: all 0.2s;
        cursor: pointer;
    }

    .header-profile-button:hover {
        background-color: #f1f5f9;
    }

    .header-profile-avatar {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 9999px;
        background-color: #0ea5e9;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
    }

    .dropdown-menu {
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 0.5rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        min-width: 12rem;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s;
        border: 1px solid #e5e7eb;
    }

    .header-profile-dropdown.active .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        color: #4b5563;
        text-decoration: none;
        transition: all 0.2s;
        width: 100%;
        border: none;
        background: none;
        cursor: pointer;
        font-size: 0.95rem;
    }

    .dropdown-item:hover {
        background-color: #f8fafc;
        color: #0ea5e9;
    }

    .dropdown-item svg {
        width: 1.25rem;
        height: 1.25rem;
    }

    .dropdown-divider {
        height: 1px;
        background-color: #e5e7eb;
        margin: 0.25rem 0;
    }

    @media (max-width: 768px) {
        .header-profile-dropdown {
            width: 100%;
        }

        .header-profile-button {
            width: 100%;
            justify-content: flex-start;
        }

        .dropdown-menu {
            position: static;
            width: 100%;
            box-shadow: none;
            border: none;
            margin-top: 0;
            background-color: transparent;
        }

        .dropdown-item {
            padding: 0.75rem 0;
        }
    }

    .search-filters {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .filter-select {
        flex: 1;
        padding: 0.625rem;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        font-size: 0.875rem;
        color: #374151;
    }

    .work-card {
        padding: 1.25rem;
        border-bottom: 1px solid #e5e7eb;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .work-card:hover {
        background-color: #f8fafc;
    }

    .work-title {
        font-weight: 500;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .work-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .work-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .skill-tag {
        background-color: #f1f5f9;
        color: #475569;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
    }
</style>

<nav class="nav-container">
    <a href="{{ url('/') }}">
        <img src="{{ asset('logo/logo.png') }}" alt="CBRS Logo" class="logo">
    </a>

    <div class="nav-links">
        <a href="{{ url('/') }}" class="nav-link">Home</a>
        <a href="#" class="nav-link" onclick="openWorkSearchPopup(); return false;">Find work</a>
        <a href="#" class="nav-link" onclick="openSearchPopup(); return false;">Find constructors</a>
        @auth
            <a href="{{ route('work.index') }}" class="nav-link">My Works</a>
            <a href="{{ route('work.unassigned') }}" class="nav-link">Available Works</a>
            
            <div class="header-profile-dropdown">
                <div class="header-profile-button" onclick="toggleDropdown()">
                    <div class="header-profile-avatar">
                        {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                    </div>
                </div>
                <div class="dropdown-menu">
                    <a href="{{ route('profile.show') }}" class="dropdown-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        My Profile
                    </a>
                    
                    @if(auth()->user()->isConstructor())
                        <a href="{{ route('bids.index') }}" class="dropdown-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Bid Insights
                        </a>
                    @endif
                    
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="dropdown-item w-full text-left">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @endauth
        @guest
            <a href="{{ route('login') }}" class="nav-link">Log In</a>
            <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
        @endguest
        <a href="{{ route('work.create') }}" class="post-project-btn">Post a project</a>
    </div>

    <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <div id="mobileMenu" class="mobile-menu">
        <div class="nav-links">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
            <a href="#" class="nav-link" onclick="openWorkSearchPopup(); return false;">Find work</a>
            <a href="#" class="nav-link" onclick="openSearchPopup(); return false;">Find constructors</a>
            @auth
                <a href="{{ route('work.index') }}" class="nav-link">My Works</a>
                <a href="{{ route('work.unassigned') }}" class="nav-link">Available Works</a>
                
                <div class="header-profile-dropdown">
                    <div class="header-profile-button" onclick="toggleDropdown()">
                        <div class="header-profile-avatar">
                            {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                        </div>
                    </div>
                    <div class="dropdown-menu">
                        <a href="{{ route('profile.show') }}" class="dropdown-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Profile
                        </a>
                        
                        @if(auth()->user()->isConstructor())
                            <a href="{{ route('bids.index') }}" class="dropdown-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Bid Insights
                            </a>
                        @endif
                        
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="dropdown-item w-full text-left">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="nav-link">Log In</a>
                <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
            @endguest
            <a href="{{ route('work.create') }}" class="post-project-btn">Post a project</a>
        </div>
    </div>
</nav>

<!-- Search Popup -->
<div id="searchPopup" class="search-popup">
    <div class="search-container">
        <div class="search-header">
            <h3 class="search-title">Search Constructors</h3>
            <button class="close-btn" onclick="closeSearchPopup()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="search-form">
            <input 
                type="text" 
                id="constructorSearch" 
                class="search-input" 
                placeholder="Search by name or skills..."
                oninput="searchConstructors(this.value)"
            >
        </div>
        <div id="searchResults" class="search-results">
            <div class="loading">
                Type to search constructors...
            </div>
        </div>
    </div>
</div>

<!-- Modify the work search popup HTML to include a form -->
<div id="workSearchPopup" class="search-popup">
    <div class="search-container">
        <div class="search-header">
            <h3 class="search-title">Search Available Works</h3>
            <button class="close-btn" onclick="closeWorkSearchPopup()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="search-form">
            <div class="search-filters">
                <select id="skillFilter" class="filter-select" multiple>
                    <option value="">Select Skills</option>
                    @foreach(App\Models\Skill::orderBy('name')->get() as $skill)
                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                    @endforeach
                </select>
                
                <select id="timeFilter" class="filter-select">
                    <option value="">Any Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                </select>
            </div>
            
            <input type="text" 
                   id="workSearch" 
                   class="search-input" 
                   placeholder="Search works by title or description..."
                   oninput="searchWorks()">
        </div>
        
        <div id="workSearchResults" class="search-results">
            <div class="loading">
                Search for available works...
            </div>
        </div>
    </div>
</div>

<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('show');
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        
        if (!mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
            mobileMenu.classList.remove('show');
        }
    });

    function openSearchPopup() {
        const searchPopup = document.getElementById('searchPopup');
        searchPopup.classList.add('show');
        document.getElementById('constructorSearch').focus();
        // Close mobile menu if it's open
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.remove('show');
    }

    function closeSearchPopup() {
        const searchPopup = document.getElementById('searchPopup');
        searchPopup.classList.remove('show');
    }

    let searchTimeout;
    function searchConstructors(query) {
        const resultsContainer = document.getElementById('searchResults');
        
        // Clear previous timeout
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            resultsContainer.innerHTML = '<div class="loading">Type at least 2 characters to search...</div>';
            return;
        }

        resultsContainer.innerHTML = `
            <div class="loading">
                <div class="loading-spinner"></div>
                Searching...
            </div>
        `;

        // Add delay to prevent too many requests
        searchTimeout = setTimeout(() => {
            fetch('/api/search-constructors?query=' + encodeURIComponent(query), {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }

                if (data.length === 0) {
                    resultsContainer.innerHTML = '<div class="no-results">No constructors found matching your search.</div>';
                    return;
                }

                resultsContainer.innerHTML = data.map(constructor => `
                    <div class="constructor-card">
                        <img src="${constructor.image || '/images/default-avatar.png'}" 
                             alt="${constructor.username}" 
                             class="constructor-image"
                             onerror="this.src='/images/default-avatar.png'">
                        <div class="constructor-info">
                            <div class="constructor-name">${constructor.username}</div>
                            <div class="constructor-details">${constructor.email}</div>
                        </div>
                        <a href="/constructors/${constructor.id}" class="view-profile-btn">View Profile</a>
                    </div>
                `).join('');
            })
            .catch(error => {
                console.error('Search error:', error);
                resultsContainer.innerHTML = `
                    <div class="error-message">
                        ${error.message || 'An error occurred while searching. Please try again.'}
                        <br>
                        <small>Please try refreshing the page if this error persists.</small>
                    </div>
                `;
            });
        }, 300);
    }

    // Close popup when clicking outside
    document.getElementById('searchPopup').addEventListener('click', function(event) {
        if (event.target === this) {
            closeSearchPopup();
        }
    });

    function toggleDropdown() {
        const dropdown = document.querySelector('.header-profile-dropdown');
        dropdown.classList.toggle('active');

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove('active');
            }
        });
    }

    // Remove the existing logout button event listener if it exists
    document.addEventListener('DOMContentLoaded', function() {
        const existingLogoutBtn = document.querySelector('.logout-btn');
        if (existingLogoutBtn) {
            existingLogoutBtn.remove();
        }
    });

    function openWorkSearchPopup() {
        const searchPopup = document.getElementById('workSearchPopup');
        searchPopup.classList.add('show');
        document.getElementById('workSearch').focus();
        
        // Initialize select2 for skills filter
        $('#skillFilter').select2({
            placeholder: 'Select Skills',
            allowClear: true,
            width: '100%'
        });
    }

    function closeWorkSearchPopup() {
        const searchPopup = document.getElementById('workSearchPopup');
        searchPopup.classList.remove('show');
    }

    let workSearchTimeout;
    function searchWorks() {
        const resultsContainer = document.getElementById('workSearchResults');
        const query = document.getElementById('workSearch').value;
        const skills = $('#skillFilter').val();
        const timeFilter = document.getElementById('timeFilter').value;
        
        // Clear previous timeout
        clearTimeout(workSearchTimeout);
        
        resultsContainer.innerHTML = `
            <div class="loading">
                <div class="loading-spinner"></div>
                Searching...
            </div>
        `;

        // Add delay to prevent too many requests
        workSearchTimeout = setTimeout(() => {
            fetch('/api/search-works?' + new URLSearchParams({
                query: query,
                skills: skills ? skills.join(',') : '',
                time: timeFilter
            }), {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }

                if (data.length === 0) {
                    resultsContainer.innerHTML = '<div class="no-results">No works found matching your search.</div>';
                    return;
                }

                resultsContainer.innerHTML = data.map(work => `
                    <div class="work-card" onclick="window.location.href='${work.has_bid ? `/work/${work.id}/bid/${work.bid_id}/edit` : `/work/${work.id}/bid`}'">
                        <h3 class="work-title">${work.title}</h3>
                        <div class="work-meta">
                            Posted ${work.created_at_human}
                            <span class="work-meta-dot"></span>
                            Budget: $${work.budget.toLocaleString()}
                        </div>
                        <div class="work-description">${work.description.substring(0, 150)}...</div>
                        <div class="work-skills">
                            ${work.skills.map(skill => `
                                <span class="skill-tag">${skill.name}</span>
                            `).join('')}
                        </div>
                        ${work.has_bid ? '<div class="bid-status">You have already bid on this work</div>' : ''}
                    </div>
                `).join('');
            })
            .catch(error => {
                console.error('Search error:', error);
                resultsContainer.innerHTML = `
                    <div class="error-message">
                        ${error.message || 'An error occurred while searching. Please try again.'}
                        <br>
                        <small>Please try refreshing the page if this error persists.</small>
                    </div>
                `;
            });
        }, 300);
    }

    // Add event listeners for filters
    document.getElementById('skillFilter').addEventListener('change', searchWorks);
    document.getElementById('timeFilter').addEventListener('change', searchWorks);

    // Close popup when clicking outside
    document.getElementById('workSearchPopup').addEventListener('click', function(event) {
        if (event.target === this) {
            closeWorkSearchPopup();
        }
    });
</script> 