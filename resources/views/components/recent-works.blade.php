<style>
    .recent-works {
        padding: 4rem 2rem;
        background-color: #ffffff;
    }

    .recent-works-container {
        max-width: 1280px;
        margin: 0 auto;
    }

    .section-subtitle {
        font-size: 1.5rem;
        color: #9ca3af;
        margin-bottom: 1rem;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 3rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .title-text span {
        color: #2563eb;
    }

    .navigation-arrows {
        display: flex;
        gap: 1rem;
    }

    .nav-arrow {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .nav-arrow.prev {
        border: 1px solid #e5e7eb;
        color: #2563eb;
    }

    .nav-arrow.next {
        background-color: #2563eb;
        color: white;
    }

    .nav-arrow:hover {
        transform: translateY(-2px);
    }

    .works-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .work-card {
        background: #ffffff;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .work-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .work-icon {
        width: 64px;
        height: 64px;
        margin-bottom: 1.5rem;
    }

    .work-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .work-description {
        font-size: 1rem;
        color: #6b7280;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .work-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1.5rem;
    }

    .bid-info {
        display: flex;
        flex-direction: column;
    }

    .bid-label {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .bid-amount {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
    }

    .apply-button {
        color: #2563eb;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .apply-button:hover {
        color: #1d4ed8;
    }

    @media (max-width: 768px) {
        .works-grid {
            grid-template-columns: 1fr;
        }

        .section-title {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .navigation-arrows {
            justify-content: center;
        }
    }
</style>

<section class="recent-works">
    <div class="recent-works-container">
        <h3 class="section-subtitle">The latest construction work!</h3>
        <div class="section-title">
            <div class="title-text">Recently Posted <span>Works</span></div>
            <div class="navigation-arrows">
                <div class="nav-arrow prev">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </div>
                <div class="nav-arrow next">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="works-grid">
            @forelse ($recentWorks as $work)
                <div class="work-card">
                    <img src="{{ asset('images/default-icon.svg') }}" alt="{{ $work->title }}" class="work-icon">
                    <h3 class="work-title">{{ $work->title }}</h3>
                    <p class="work-description">{{ Str::limit($work->description, 100) }}</p>
                    <div class="work-footer">
                        <div class="bid-info">
                            <span class="bid-label">Highest bid</span>
                            <span class="bid-amount">
                                Tsh {{ 
                                    $work->bids()->exists() 
                                    ? number_format($work->bids()->max('bid_amount'), 0) 
                                    : '500' 
                                }}
                            </span>
                        </div>
                        <a href="{{ route('work.bid', $work->id) }}" class="apply-button">Apply now</a>
                    </div>
                </div>
            @empty
                <p>No recent works available.</p>
            @endforelse
        </div>
    </div>
</section>