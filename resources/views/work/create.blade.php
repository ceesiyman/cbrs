@extends('layouts.app')

@section('content')
<style>
    .work-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .work-form {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }

    .form-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 2rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 0.875rem;
        color: #1f2937;
        transition: border-color 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .skills-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .skill-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .skill-checkbox:hover {
        background-color: #f8fafc;
        border-color: #0ea5e9;
    }

    .skill-checkbox input[type="checkbox"] {
        width: 1rem;
        height: 1rem;
        border-radius: 4px;
        border: 1px solid #e5e7eb;
        cursor: pointer;
    }

    .form-submit {
        background-color: #0ea5e9;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
        width: 100%;
    }

    .form-submit:hover {
        background-color: #0284c7;
    }

    .error-message {
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    @media (max-width: 640px) {
        .work-container {
            margin: 1rem auto;
        }

        .work-form {
            padding: 1.5rem;
        }

        .skills-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="work-container">
    <div class="work-form">
        <h1 class="form-title">Create New Work Project</h1>
        
        <form action="{{ route('work.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="title" class="form-label">Project Title</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       class="form-input" 
                       value="{{ old('title') }}"
                       required>
                @error('title')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Project Description</label>
                <textarea id="description" 
                          name="description" 
                          class="form-input form-textarea" 
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" 
                       id="start_date" 
                       name="start_date" 
                       class="form-input" 
                       value="{{ old('start_date') }}"
                       required>
                @error('start_date')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="total_cost" class="form-label">Total Cost</label>
                <input type="number" 
                       id="total_cost" 
                       name="total_cost" 
                       class="form-input" 
                       step="0.01" 
                       min="0"
                       value="{{ old('total_cost') }}"
                       required>
                @error('total_cost')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="budget" class="form-label">Budget</label>
                <input type="number" 
                       id="budget" 
                       name="budget" 
                       class="form-input" 
                       step="0.01" 
                       min="0"
                       value="{{ old('budget') }}"
                       required>
                @error('budget')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Required Skills</label>
                <div class="skills-grid">
                    @foreach($skills as $skill)
                        <label class="skill-checkbox">
                            <input type="checkbox" 
                                   name="skills[]" 
                                   value="{{ $skill->id }}"
                                   {{ in_array($skill->id, old('skills', [])) ? 'checked' : '' }}>
                            {{ $skill->name }}
                        </label>
                    @endforeach
                </div>
                @error('skills')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="form-submit">Create Project</button>
        </form>
    </div>
</div>
@endsection 