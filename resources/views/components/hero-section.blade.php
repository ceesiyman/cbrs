<!-- Hero Section Component with Guaranteed Visible Results -->
<style>
    .hero-section {
        background: linear-gradient(to right, #f8fafc, #f1f5f9);
        padding: 4rem 1rem;
    }

    .container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 3rem;
        align-items: center;
    }

    .hero-content {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        color: #1f2937;
        line-height: 1.2;
    }

    .hero-title span {
        color: #2563eb;
    }

    .hero-description {
        font-size: 1.25rem;
        color: #4b5563;
    }

    .hero-actions {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .hire-button {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.375rem;
        background-color: #2563eb;
        color: white;
        font-size: 1rem;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.15s;
    }

    .hire-button:hover {
        background-color: #1d4ed8;
    }

    

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .hero-image {
        position: relative;
        height: 24rem;
    }

    .image-container {
        position: absolute;
        inset: 0;
        border-radius: 1rem;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        mix-blend-mode: normal;
    }

    

    @media (min-width: 640px) {
        .hero-actions {
            flex-direction: row;
        }

        
    }

    @media (min-width: 1024px) {
        .hero-grid {
            grid-template-columns: 1fr 1fr;
        }

        .hero-image {
            height: 32rem;
        }
        
        /* Fixed: Adjust the hire button size on desktop */
        .hire-button {
            min-width: 180px;
            padding: 0.75rem 1.75rem;
            white-space: nowrap;
        }
    }
</style>

@php
    $imagePath = public_path('images/constructor-silhouette.jpg');
    $imageUrl = asset('images/constructor-silhouette.jpg');
@endphp

<div class="hero-section">
    <div class="container">
        <div class="hero-grid">
            <!-- Left Content -->
            <div class="hero-content">
                <h1 class="hero-title">
                    Are you looking for<br>
                    <span>Constructors?</span>
                </h1>
                <p class="hero-description">
                    Hire Great constructors, Fast. Spacelance helps you hire elite constructors at a moment's notice
                </p>
                <div class="hero-actions">
                    <a href="{{ route('hire-constructor') }}" class="hire-button">
                        Hire a constructor
                    </a>
                    
                </div>
            </div>
            
            <!-- Right Image -->
            <div class="hero-image">
                <div class="image-container">
                    <img src="{{ asset('images/constructor-silhouette.jpg') }}" 
                         alt="Constructor silhouette" 
                         class="hero-img"
                         onerror="this.onerror=null; this.src='{{ asset('images/default-hero.jpg') }}'">
                </div>
            </div>
        </div>
    </div>
</div>

