<style>
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

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .category-card {
        position: relative;
        aspect-ratio: 1;
        border-radius: 1rem;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .category-card:hover {
        transform: translateY(-5px);
    }

    .category-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .category-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.7));
        display: flex;
        align-items: flex-end;
        padding: 1.5rem;
    }

    .category-name {
        color: white;
        font-size: 1.25rem;
        font-weight: 600;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .more-categories {
        text-align: center;
        margin-top: 2rem;
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

    @media (max-width: 1024px) {
        .categories-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .categories-grid {
            grid-template-columns: 1fr;
        }

        .categories-title {
            font-size: 2rem;
        }
    }
</style>

<section class="categories-section">
    <div class="categories-container">
        <h2 class="categories-title">Choose Different <span>Category</span></h2>
        
        <div class="categories-grid">
            <!-- General Construction -->
            <div class="category-card">
                <img src="{{ asset('images/categories/general-construction.jpg') }}" alt="General Construction" class="category-image">
                <div class="category-overlay">
                    <h3 class="category-name">General Construction</h3>
                </div>
            </div>

            <!-- Renovation -->
            <div class="category-card">
                <img src="{{ asset('images/categories/renovation.jpg') }}" alt="Renovation" class="category-image">
                <div class="category-overlay">
                    <h3 class="category-name">Renovation</h3>
                </div>
            </div>

            <!-- Specialized Construction -->
            <div class="category-card">
                <img src="{{ asset('images/categories/specialized-construction.jpg') }}" alt="Specialized Construction" class="category-image">
                <div class="category-overlay">
                    <h3 class="category-name">Specialized Construction</h3>
                </div>
            </div>

            <!-- Electrical -->
            <div class="category-card">
                <img src="{{ asset('images/categories/electrical.jpg') }}" alt="Electrical" class="category-image">
                <div class="category-overlay">
                    <h3 class="category-name">Electrical</h3>
                </div>
            </div>

            <!-- Interior & Exterior Finishing -->
            <div class="category-card">
                <img src="{{ asset('images/categories/interior-exterior.jpg') }}" alt="Interior & Exterior Finishing" class="category-image">
                <div class="category-overlay">
                    <h3 class="category-name">Interior & Exterior Finishing</h3>
                </div>
            </div>

            <!-- Structural Services -->
            <div class="category-card">
                <img src="{{ asset('images/categories/structural-services.jpg') }}" alt="Structural Services" class="category-image">
                <div class="category-overlay">
                    <h3 class="category-name">Structural Services</h3>
                </div>
            </div>

            <!-- Machinery Renting -->
            <div class="category-card">
                <img src="{{ asset('images/categories/machinery-renting.jpg') }}" alt="Machinery Renting" class="category-image">
                <div class="category-overlay">
                    <h3 class="category-name">Machinery Renting</h3>
                </div>
            </div>

            <!-- Architecture -->
            <div class="category-card">
                <img src="{{ asset('images/categories/architecture.jpg') }}" alt="Architecture" class="category-image">
                <div class="category-overlay">
                    <h3 class="category-name">Architecture</h3>
                </div>
            </div>
        </div>

        <div class="more-categories">
            <a href="#" class="more-categories-btn">More Categories</a>
        </div>
    </div>
</section>