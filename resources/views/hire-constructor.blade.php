@extends('layouts.app')

@section('content')
<style>
    .page-container {
        padding: 3rem 1rem;
    }

    .content-wrapper {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .content-card {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-body {
        padding: 1.5rem;
    }

    .page-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.5rem;
    }

    .search-section {
        margin-bottom: 2rem;
    }

    .search-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .search-input {
        flex-grow: 1;
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 1rem;
        outline: none;
    }

    .search-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }

    .filter-select {
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 1rem;
        outline: none;
    }

    .filter-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }

    .constructors-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .constructor-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-content {
        padding: 1.5rem;
    }

    .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .profile-image {
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
    }

    .profile-info {
        margin-left: 1rem;
    }

    .profile-name {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
    }

    .profile-role {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .rating {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .star-icon {
        width: 1.25rem;
        height: 1.25rem;
        color: #fbbf24;
    }

    .rating-text {
        margin-left: 0.25rem;
    }

    .profile-description {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .tag {
        padding: 0.25rem 0.75rem;
        background: #dbeafe;
        color: #1e40af;
        font-size: 0.75rem;
        border-radius: 9999px;
    }

    .view-profile-btn {
        width: 100%;
        padding: 0.5rem 1rem;
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.15s;
    }

    .view-profile-btn:hover {
        background: #1d4ed8;
    }

    .pagination {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .pagination-nav {
        display: inline-flex;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .page-link {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        background: white;
        color: #374151;
        font-size: 0.875rem;
        text-decoration: none;
    }

    .page-link:hover {
        background: #f3f4f6;
    }

    .page-link:first-child {
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
    }

    .page-link:last-child {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
    }

    @media (min-width: 640px) {
        .search-form {
            flex-direction: row;
        }

        .filter-select {
            width: auto;
        }
    }

    @media (min-width: 768px) {
        .constructors-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .constructors-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>

<div class="page-container">
    <div class="content-wrapper">
        <div class="content-card">
            <div class="card-body">
                <h1 class="page-title">Hire a Constructor</h1>
                
                <!-- Search and Filter Section -->
                <div class="search-section">
                    <div class="search-form">
                        <input type="text" 
                               placeholder="Search constructors by name, skills, or location" 
                               class="search-input">
                        <select class="filter-select">
                            <option value="">Filter by specialty</option>
                            <option value="residential">Residential</option>
                            <option value="commercial">Commercial</option>
                            <option value="industrial">Industrial</option>
                            <option value="renovation">Renovation</option>
                        </select>
                    </div>
                </div>

                <!-- Constructors Grid -->
                <div class="constructors-grid">
                    <!-- Constructor Card Template -->
                    <div class="constructor-card">
                        <div class="card-content">
                            <div class="profile-header">
                                <img class="profile-image" src="https://via.placeholder.com/100" alt="Constructor profile">
                                <div class="profile-info">
                                    <h3 class="profile-name">John Doe</h3>
                                    <p class="profile-role">Residential Constructor</p>
                                </div>
                            </div>
                            <div class="rating">
                                <svg class="star-icon" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="rating-text">4.8 (156 reviews)</span>
                            </div>
                            <p class="profile-description">Specializing in modern residential construction with 10+ years of experience.</p>
                            <div class="tags">
                                <span class="tag">Residential</span>
                                <span class="tag">New Construction</span>
                                <span class="tag">Renovation</span>
                            </div>
                            <button class="view-profile-btn">View Profile</button>
                        </div>
                    </div>

                    <!-- Add more constructor cards here -->
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <nav class="pagination-nav">
                        <a href="#" class="page-link">Previous</a>
                        <a href="#" class="page-link">1</a>
                        <a href="#" class="page-link">2</a>
                        <a href="#" class="page-link">3</a>
                        <a href="#" class="page-link">Next</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 