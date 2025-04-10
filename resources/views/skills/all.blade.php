{{-- skills/all.blade.php --}}

@extends('layouts.app')

@section('content')
<section class="categories-section">
    <div class="categories-container">
        <h2 class="categories-title">All Available <span>Skills</span></h2>
        
        <div class="categories-grid">
            @foreach($skills as $skill)
            <div class="category-card">
                <a href="{{ route('works.by.skill', $skill->id) }}">
                    <img src="{{ asset('images/categories/' . Str::slug($skill->name) . '.jpg') }}" 
                         alt="{{ $skill->name }}" 
                         class="category-image"
                         onerror="this.src='{{ asset('images/categories/default.jpg') }}'">
                    <div class="category-overlay">
                        <h3 class="category-name">{{ $skill->name }}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="more-categories">
            <a href="{{ url()->previous() }}" class="more-categories-btn">
                Go Back
            </a>
        </div>
    </div>
</section>

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
@endsection