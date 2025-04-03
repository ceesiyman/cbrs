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
            <!-- Step 1 -->
            <div class="step-card">
                <div class="step-icon-container">
                    <svg class="step-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="step-title">Create Account</h3>
                <p class="step-description">First you have to create a account here</p>
            </div>

            <!-- Step 2 -->
            <div class="step-card">
                <div class="step-icon-container">
                    <svg class="step-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="step-title">Search work</h3>
                <p class="step-description">Search the best construction work here</p>
            </div>

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