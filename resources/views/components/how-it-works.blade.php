<style>
    .steps-section {
        padding: 5rem 1rem;
        background-color: #ffffff;
    }

    .steps-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .steps-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .steps-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .steps-subtitle {
        font-size: 1.125rem;
        color: #6b7280;
    }

    .steps-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .step-card {
        text-align: center;
        padding: 2rem;
        background: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
    }

    .step-card:hover {
        transform: translateY(-5px);
    }

    .step-icon-container {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: #f0f9ff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .step-icon {
        width: 40px;
        height: 40px;
        color: #2563eb;
    }

    .step-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.75rem;
    }

    .step-description {
        font-size: 1rem;
        color: #6b7280;
        line-height: 1.5;
    }

    @media (min-width: 768px) {
        .steps-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>

<section class="steps-section">
    <div class="steps-container">
        <div class="steps-header">
            <h2 class="steps-title">How It Works</h2>
            <p class="steps-subtitle">Get started with CBRS in three simple steps</p>
        </div>

        <div class="steps-grid">
            <!-- Step 1 --><a href="{{ route('register') }}" class="nav-link">
            <div class="step-card">
                <div class="step-icon-container">
                    <svg class="step-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="step-title">Create Account</h3>
                <p class="step-description">First you have to create a account here</p>
            </div>
            </a>
            <!-- Step 2 --><a href="#" class="nav-link" onclick="openWorkSearchPopup(); return false;">
            <div class="step-card">
                <div class="step-icon-container">
                    <svg class="step-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="step-title">Search work</h3>
                <p class="step-description">Search the best construction work here</p>
            </div>
            </a>

            <!-- Step 3 -->
            <div class="step-card">
                <div class="step-icon-container">
                    <svg class="step-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="step-title">Save and apply</h3>
                <p class="step-description">Apply or save and start your work</p>
            </div>
        </div>
    </div>
</section> 

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