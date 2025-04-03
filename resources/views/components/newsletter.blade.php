<style>
    .newsletter-section {
        padding: 4rem 2rem;
        background-color: #f0f9ff;
        text-align: center;
    }

    .newsletter-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .newsletter-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .newsletter-description {
        font-size: 1.125rem;
        color: #6b7280;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .newsletter-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        max-width: 450px;
        margin: 0 auto;
    }

    .email-input {
        width: 100%;
        padding: 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 1rem;
        color: #374151;
        background-color: white;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .email-input::placeholder {
        color: #9ca3af;
    }

    .email-input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .subscribe-button {
        width: 100%;
        padding: 1rem;
        background-color: #2563eb;
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .subscribe-button:hover {
        background-color: #1d4ed8;
    }

    .alert {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }

    .alert-success {
        background-color: #ecfdf5;
        color: #047857;
        border: 1px solid #059669;
    }

    .alert-error {
        background-color: #fef2f2;
        color: #b91c1c;
        border: 1px solid #dc2626;
    }

    @media (min-width: 640px) {
        .newsletter-form {
            flex-direction: row;
        }

        .email-input {
            flex: 1;
        }

        .subscribe-button {
            width: auto;
            padding: 1rem 2rem;
        }
    }
</style>

<section class="newsletter-section">
    <div class="newsletter-container">
        <h2 class="newsletter-title">Newsletter Subscription</h2>
        <p class="newsletter-description">Subscribe to our newsletter to get new construction work and projects</p>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
            @csrf
            <input 
                type="email" 
                name="email" 
                class="email-input" 
                placeholder="Enter your email address" 
                required
                value="{{ old('email') }}"
            >
            <button type="submit" class="subscribe-button">Subscribe</button>
        </form>
    </div>
</section> 