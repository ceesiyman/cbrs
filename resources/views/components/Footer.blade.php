<style>
    .footer {
        background-color: white;
        padding: 3rem 2rem;
        border-top: 1px solid #e5e7eb;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-content {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .footer-logo-section img {
        height: 60px;
        width: auto;
        margin-bottom: 1rem;
    }

    .footer-description {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        max-width: 400px;
    }

    .social-links {
        display: flex;
        gap: 1rem;
    }

    .social-link {
        color: #64748b;
        transition: color 0.2s;
    }

    .social-link:hover {
        color: #0ea5e9;
    }

    .footer-section h3 {
        color: #1e293b;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-link {
        margin-bottom: 0.75rem;
    }

    .footer-link a {
        color: #64748b;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.2s;
    }

    .footer-link a:hover {
        color: #0ea5e9;
    }

    .contact-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
    }

    .contact-info svg {
        width: 16px;
        height: 16px;
    }

    .copyright {
        text-align: center;
        color: #94a3b8;
        font-size: 0.9rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }

    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .footer-logo-section {
            margin-bottom: 1rem;
        }
    }
</style>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <!-- Logo and Description Section -->
            <div class="footer-logo-section">
                <img src="{{ asset('logo/logo.png') }}" alt="CBRS Logo">
                <p class="footer-description">
                    Powerful Construction Marketplace System with ability to change the Users (constructors & Clients)
                </p>
                <div class="social-links">
                    <a href="#" class="social-link">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- For Clients Section -->
            <div class="footer-section">
                <h3>For Clients</h3>
                <ul class="footer-links">
                    <li class="footer-link">
                    <a href="{{ route('constructors.index') }}">Find constructors</a>
                    </li>
                    <li class="footer-link">
                        <a href="{{ route('work.create') }}">Post Project</a>
                    </li>
                    <li class="footer-link">
                        <a href="{{ url('/refund-policy') }}">Refund Policy</a>
                    </li>
                    <li class="footer-link">
                        <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
                    </li>
                </ul>
            </div>

            <!-- For Constructors Section -->
            <div class="footer-section">
                <h3>For Constructors</h3>
                <ul class="footer-links">
                    <li class="footer-link">
                    <a href="{{ route('work.unassigned') }}">Find work</a>
                    </li>
                    <li class="footer-link">
                        <a href="{{ route('register') }}" class="nav-link">Create Account</a>
                    </li>
                </ul>
            </div>

            <!-- Call Us Section -->
            <div class="footer-section">
                <h3>Call Us</h3>
                <ul class="footer-links">
                    <li class="contact-info">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Dar Es Salaam, Tanzania
                    </li>
                    <li class="contact-info">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:+254700000000">+255744330332</a>
                    </li>
                    <li class="contact-info">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:bluelance@gmail.com">cbrs@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="copyright">
            2022 c.b.r.s. All right reserved
        </div>
    </div>
</footer> 

<!-- Search Popup -->


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
                            Budget: TSh ${work.budget.toLocaleString()}
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