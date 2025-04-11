@extends('layouts.app')

@section('content')
<style>
    .hire-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    
    .hire-form-card {
        max-width: 768px;
        margin: 0 auto;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
    }
    
    .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .profile-image {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        margin-right: 1rem;
        object-fit: cover;
    }
    
    .hire-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a202c;
        margin: 0;
    }
    
    .constructor-role {
        color: #3182ce;
        margin: 0.25rem 0 0 0;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        font-weight: 500;
        color: #4a5568;
        margin-bottom: 0.5rem;
    }
    
    .form-select {
        width: 100%;
        padding: 0.5rem 1rem;
        border: 1px solid #cbd5e0;
        border-radius: 0.375rem;
        font-size: 1rem;
        outline: none;
    }
    
    .form-select:focus {
        border-color: #3182ce;
        box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.3);
    }
    
    .alert {
        padding: 0.75rem 1rem;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
    }
    
    .alert-error {
        background-color: #fed7d7;
        border: 1px solid #f56565;
        color: #c53030;
    }
    
    .alert-warning {
        background-color: #fefcbf;
        border: 1px solid #ecc94b;
        color: #b7791f;
    }
    
    .form-actions {
        display: flex;
        justify-content: flex-end;
    }
    
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        border: none;
    }
    
    .btn-cancel {
        background-color: #edf2f7;
        color: #4a5568;
        margin-right: 0.5rem;
    }
    
    .btn-cancel:hover {
        background-color: #e2e8f0;
    }
    
    .btn-primary {
        background-color: #3182ce;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #2b6cb0;
    }
    
    .btn-primary:disabled {
        opacity: 0.65;
        cursor: not-allowed;
    }
    
    .link {
        color: inherit;
        text-decoration: underline;
    }
</style>

<div class="hire-container">
    <div class="hire-form-card">
        <div class="profile-header">
            <img src="{{ $constructor->image ?? asset('images/default-avatar.png') }}" 
                 alt="{{ $constructor->username }}" 
                 class="profile-image">
            <div>
                <h1 class="hire-title">Hire {{ $constructor->username }}</h1>
                <p class="constructor-role">{{ $constructor->role }}</p>
            </div>
        </div>
        
        <form action="{{ route('hire.constructor.send', $constructor) }}" method="POST">
            @csrf
            
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="form-group">
                <label for="work_id" class="form-label">Select a project:</label>
                
                @if($unassignedWorks->isEmpty())
                    <div class="alert alert-warning">
                        You don't have any unassigned projects. <a href="{{ route('work.create') }}" class="link">Create a new project</a> first.
                    </div>
                @else
                    <select name="work_id" id="work_id" class="form-select">
                        <option value="">-- Select a project --</option>
                        @foreach($unassignedWorks as $work)
                            <option value="{{ $work->id }}">{{ $work->title }} (Budget: ${{ number_format($work->budget) }})</option>
                        @endforeach
                    </select>
                @endif
            </div>
            
            <div class="form-actions">
                <a href="{{ route('constructor.profile', $constructor) }}" class="btn btn-cancel">Cancel</a>
                <button type="submit" class="btn btn-primary" {{ $unassignedWorks->isEmpty() ? 'disabled' : '' }}>
                    Send Hire Request
                </button>
            </div>
        </form>
    </div>
</div>
@endsection