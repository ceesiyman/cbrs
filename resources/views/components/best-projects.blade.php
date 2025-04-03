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
    }

    @media (max-width: 640px) {
        .projects-grid {
            grid-template-columns: 1fr;
        }

        .section-title {
            font-size: 2rem;
        }
    }
</style>

<section class="projects-section">
    <div class="projects-container">
        <h3 class="section-subtitle">Houses, Architecture, Interior Design & more!</h3>
        <h2 class="section-title">Checkout The Best <span>Projects</span> Here</h2>

        <div class="projects-grid">
            <!-- Project Card 1 -->
            <div class="project-card">
                <img src="{{ asset('images/projects/bunny-design.jpg') }}" alt="Bunny Design" class="project-image">
                <div class="project-info">
                    <div class="project-title">
                        <div>
                            <h3>Bunny.design</h3>
                            <p class="project-role">UI/UX Designer</p>
                        </div>
                        <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Project Card 2 -->
            <div class="project-card">
                <img src="{{ asset('images/projects/bhaskar-tiwari.jpg') }}" alt="Bhaskar Tiwari" class="project-image">
                <div class="project-info">
                    <div class="project-title">
                        <div>
                            <h3>Bhaskar Tiwari</h3>
                            <p class="project-role">Graphic Designer</p>
                        </div>
                        <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Project Card 3 -->
            <div class="project-card">
                <img src="{{ asset('images/projects/aksara-joshi.jpg') }}" alt="Aksara Joshi" class="project-image">
                <div class="project-info">
                    <div class="project-title">
                        <div>
                            <h3>Aksara Joshi</h3>
                            <p class="project-role">Graphic Designer</p>
                        </div>
                        <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="pagination-dots">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
</section> 