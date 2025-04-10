@extends('layouts.app')
@section('content')
<section class="dashboard-section">
    <div class="dashboard-container">
        <div class="dashboard-card">
            <div class="user-welcome">
                <h1 class="welcome-title">Welcome, {{ Auth::user()->username }}!</h1>
                <div class="user-info">
                    <p class="info-item">Role: {{ Auth::user()->role }}</p>
                    <p class="info-item">Email: {{ Auth::user()->email }}</p>
                    <p class="info-item">Phone: {{ Auth::user()->phone_number }}</p>
                </div>
            </div>
            
            @if(Auth::user()->role === 'Constructor')
            <div class="dashboard-section">
                <h2 class="section-title">Constructor <span>Dashboard</span></h2>
                <div class="dashboard-grid">
                    <a href="{{ route('work.index') }}" class="dashboard-item constructor-projects">
                        <h3 class="item-title">My Projects</h3>
                        <p class="item-description">View and manage your construction projects</p>
                    </a>
                    <a href="{{ route('work.unassigned') }}" class="dashboard-item constructor-available">
                        <h3 class="item-title">Available Projects</h3>
                        <p class="item-description">Browse and bid on new projects</p>
                    </a>
                    <a href="{{ route('profile.show') }}" class="dashboard-item constructor-profile">
                        <h3 class="item-title">Profile Settings</h3>
                        <p class="item-description">Update your profile and preferences</p>
                    </a>
                </div>
            </div>
            @else
            <div class="dashboard-section">
                <h2 class="section-title">Client <span>Dashboard</span></h2>
                <div class="dashboard-grid">
                    <a href="{{ route('work.index') }}" class="dashboard-item client-projects">
                        <h3 class="item-title">My Projects</h3>
                        <p class="item-description">View and manage your construction projects</p>
                    </a>
                    <a href="{{ route('work.unassigned') }}" class="dashboard-item client-new">
                        <h3 class="item-title">Post New Project</h3>
                        <p class="item-description">Create a new construction project</p>
                    </a>
                    <a href="{{ route('profile.show') }}" class="dashboard-item client-profile">
                        <h3 class="item-title">Profile Settings</h3>
                        <p class="item-description">Update your profile and preferences</p>
                    </a>
                </div>
            </div>
            @endif
            
            <div class="logout-section">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    .dashboard-section {
        padding: 4rem 2rem;
        background-color: #f8fafc;
    }
    
    .dashboard-container {
        max-width: 1280px;
        margin: 0 auto;
    }
    
    .dashboard-card {
        background-color: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        padding: 2rem;
    }
    
    .user-welcome {
        margin-bottom: 2rem;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 1.5rem;
    }
    
    .welcome-title {
        font-size: 1.75rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    
    .user-info {
        margin-bottom: 1rem;
    }
    
    .info-item {
        color: #6b7280;
        margin-bottom: 0.5rem;
    }
    
    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.5rem;
    }
    
    .section-title span {
        color: #2563eb;
    }
    
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .dashboard-item {
        padding: 1.5rem;
        border-radius: 0.75rem;
        transition: transform 0.3s ease;
        text-decoration: none;
    }
    
    .dashboard-item:hover {
        transform: translateY(-5px);
    }
    
    .constructor-projects,
    .client-projects {
        background-color: #dbeafe;
    }
    
    .constructor-available,
    .client-new {
        background-color: #dcfce7;
    }
    
    .constructor-profile,
    .client-profile {
        background-color: #f3e8ff;
    }
    
    .item-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .item-description {
        font-size: 0.875rem;
        color: #6b7280;
    }
    
    .logout-section {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f1f5f9;
    }
    
    .logout-button {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        background-color: #ef4444;
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .logout-button:hover {
        background-color: #dc2626;
    }
    
    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 640px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
        
        .welcome-title {
            font-size: 1.5rem;
        }
        
        .section-title {
            font-size: 1.25rem;
        }
    }
</style>
@endsection