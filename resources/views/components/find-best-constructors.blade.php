<style>
    .find-constructors {
        padding: 4rem 2rem;
        background-color: #ffffff;
        position: relative;
    }

    .find-container {
        max-width: 1280px;
        margin: 0 auto;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 4rem;
    }

    .image-side {
        flex: 0 0 40%;
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .constructor1-image {
        width: 100%;
        max-width: 450px;
        height: auto;
        display: block;
        object-fit: contain;
    }

    .content-side {
        flex: 0 0 60%;
        padding-left: 2rem;
    }

    .find-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .find-title span {
        color: #2563eb;
    }

    .find-description {
        font-size: 1.125rem;
        line-height: 1.7;
        color: #6b7280;
        margin-bottom: 2rem;
        max-width: 600px;
    }

    .stats {
        display: flex;
        gap: 4rem;
        margin-top: 2rem;
    }

    .stats-item {
        flex: 1;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2563eb;
        margin-bottom: 0.5rem;
    }

    .stats-label {
        font-size: 1.125rem;
        color: #6b7280;
        text-transform: capitalize;
    }

    @media (max-width: 768px) {
        .find-container {
            flex-direction: column;
            text-align: center;
            gap: 2rem;
        }

        .image-side {
            flex: 0 0 100%;
            justify-content: center;
        }

        .content-side {
            flex: 0 0 100%;
            padding-left: 0;
        }

        .stats {
            justify-content: center;
            gap: 2rem;
        }

        .find-title {
            font-size: 2rem;
        }

        .find-description {
            margin-left: auto;
            margin-right: auto;
        }
    }
</style>

<section class="find-constructors">
    <div class="find-container">
        <div class="image-side">
            <img src="{{ asset('images/constructor-professional.jpg') }}" alt="Professional Constructor" class="constructor1-image">
        </div>
        <div class="content-side">
            <h2 class="find-title">Find The Best <span>Constructors</span> Here</h2>
            <p class="find-description">
                Discover top-quality construction and building services tailored to your needs. 
                Whether you're planning a new project or renovating an existing space, we connect 
                you with experienced contractors and skilled builders. Get reliable, professional, 
                and efficient services to bring your vision to life. Book your trusted construction 
                experts today!
            </p>
            <div class="stats">
                <div class="stats-item">
                    <div class="stats-number">500+</div>
                    <div class="stats-label">constructors</div>
                </div>
                <div class="stats-item">
                    <div class="stats-number">300+</div>
                    <div class="stats-label">constructors work Posted</div>
                </div>
            </div>
        </div>
    </div>
</section> 