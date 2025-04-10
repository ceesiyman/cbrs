<section class="projects-section">
    <div class="projects-container">
        <h3 class="section-subtitle">Houses, Architecture, Interior Design & more!</h3>
        <h2 class="section-title">Checkout The Best <span>Projects</span> Here</h2>

        <div class="projects-grid" id="projects-carousel">
            @foreach($topWorks->chunk(3) as $index => $chunk)
                <div class="carousel-page {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                    @foreach($chunk as $work)
                        <div class="project-card" onclick="window.location='{{ route('work.show', $work->id) }}'">
                            <img src="{{ asset('images/projects/' . Str::slug($work->title) . '.jpg') }}" 
                                alt="{{ $work->title }}" 
                                class="project-image"
                                onerror="this.src='{{ asset('images/projects/default.jpg') }}'">
                            <div class="project-info">
                                <div class="project-title">
                                    <div>
                                        <h3>{{ $work->title }}</h3>
                                        <p class="project-role">{{ $work->bids_max_bid_amount ? '$'.number_format($work->bids_max_bid_amount, 2) : 'N/A' }}</p>
                                    </div>
                                    <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="pagination-dots">
            @foreach($topWorks->chunk(3) as $index => $chunk)
                <div class="dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}" onclick="showPage({{ $index }})"></div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .projects-section {
        padding: 4rem 2rem;
        background-color: #ffffff;
    }

    .projects-container {
        max-width: 1280px;
        margin: 0 auto;
    }

    .section-subtitle {
        text-align: center;
        font-size: 1.25rem;
        color: #9ca3af;
        margin-bottom: 1rem;
    }

    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 3rem;
    }

    .section-title span {
        color: #2563eb;
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-bottom: 2rem;
        position: relative;
    }

    .carousel-page {
        display: none;
        grid-column: 1 / -1;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        width: 100%;
    }

    .carousel-page.active {
        display: grid;
    }

    .project-card {
        background: #ffffff;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .project-card:hover {
        transform: translateY(-5px);
    }

    .project-image {
        width: 100%;
        height: 240px;
        object-fit: cover;
    }

    .project-info {
        padding: 1.5rem;
    }

    .project-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .project-role {
        font-size: 1rem;
        color: #6b7280;
    }

    .arrow-icon {
        width: 24px;
        height: 24px;
        color: #2563eb;
    }

    .pagination-dots {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }

    .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #e5e7eb;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dot.active {
        width: 24px;
        border-radius: 4px;
        background-color: #2563eb;
    }

    @media (max-width: 1024px) {
        .projects-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .carousel-page {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .projects-grid {
            grid-template-columns: 1fr;
        }
        
        .carousel-page {
            grid-template-columns: 1fr;
        }

        .section-title {
            font-size: 2rem;
        }
    }
</style>

<script>
    function showPage(index) {
        // Hide all pages
        const pages = document.querySelectorAll('.carousel-page');
        pages.forEach(page => {
            page.classList.remove('active');
        });
        
        // Show selected page
        const selectedPage = document.querySelector(`.carousel-page[data-index="${index}"]`);
        if (selectedPage) {
            selectedPage.classList.add('active');
        }
        
        // Update dots
        const dots = document.querySelectorAll('.dot');
        dots.forEach(dot => {
            dot.classList.remove('active');
        });
        
        const selectedDot = document.querySelector(`.dot[data-index="${index}"]`);
        if (selectedDot) {
            selectedDot.classList.add('active');
        }
    }
    
    // Auto-scroll functionality
    let currentPage = 0;
    const totalPages = document.querySelectorAll('.carousel-page').length;
    
    function autoScroll() {
        currentPage = (currentPage + 1) % totalPages;
        showPage(currentPage);
    }
    
    // Auto-scroll every 5 seconds
    const scrollInterval = setInterval(autoScroll, 5000);
    
    // Pause auto-scroll when user interacts with dots
    const dots = document.querySelectorAll('.dot');
    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            clearInterval(scrollInterval);
            currentPage = parseInt(this.getAttribute('data-index'));
            
            // Restart auto-scroll after 10 seconds of inactivity
            setTimeout(() => {
                scrollInterval = setInterval(autoScroll, 5000);
            }, 10000);
        });
    });
</script>