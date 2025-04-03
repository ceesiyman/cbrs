@extends('layouts.app')

@section('content')
<style>
    .profile-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .profile-header {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        margin-bottom: 2rem;
        display: flex;
        gap: 2rem;
        align-items: start;
    }

    .profile-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #f8fafc;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-image-placeholder {
        width: 100%;
        height: 100%;
        background-color: #0ea5e9;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 600;
    }

    .profile-info {
        flex: 1;
    }

    .profile-name {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .profile-role {
        font-size: 1.125rem;
        color: #0ea5e9;
        margin-bottom: 1rem;
    }

    .profile-contact {
        display: flex;
        gap: 2rem;
        margin-bottom: 1.5rem;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #64748b;
    }

    .contact-item svg {
        width: 20px;
        height: 20px;
    }

    .profile-section {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .skills-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .skill-tag {
        background-color: #f0f9ff;
        color: #0ea5e9;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .work-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .work-item {
        background-color: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 1.5rem;
        transition: all 0.2s;
    }

    .work-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-color: #0ea5e9;
    }

    .work-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .work-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
    }

    .work-status {
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status-in-progress {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .status-completed {
        background-color: #dcfce7;
        color: #166534;
    }

    .work-client {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
    }

    .work-description {
        color: #4b5563;
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .work-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
        font-size: 0.875rem;
    }

    .work-date {
        color: #6b7280;
    }

    .work-budget {
        font-weight: 500;
        color: #1f2937;
    }

    .text-gray-500 {
        color: #6b7280;
    }

    .profile-header-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .edit-profile-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background-color: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        color: #4b5563;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .edit-profile-btn:hover {
        background-color: #f1f5f9;
        border-color: #0ea5e9;
        color: #0ea5e9;
    }

    .edit-icon {
        width: 1.25rem;
        height: 1.25rem;
    }

    .edit-profile-form {
        background-color: #f8fafc;
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        border: 1px solid #e5e7eb;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #4b5563;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.625rem;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 0.875rem;
        color: #1f2937;
        transition: all 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .save-btn {
        padding: 0.625rem 1.25rem;
        background-color: #0ea5e9;
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .save-btn:hover {
        background-color: #0284c7;
    }

    .cancel-btn {
        padding: 0.625rem 1.25rem;
        background-color: white;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .cancel-btn:hover {
        background-color: #f1f5f9;
        border-color: #d1d5db;
    }

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 1.5rem;
        }

        .profile-contact {
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        .work-grid {
            grid-template-columns: 1fr;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
        }

        .profile-name {
            font-size: 1.5rem;
        }

        .profile-section {
            padding: 1.5rem;
        }

        .profile-header-top {
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .edit-profile-form {
            padding: 1rem;
        }
    }

    .experience-item {
        padding: 1.5rem 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .experience-item:last-child {
        border-bottom: none;
    }

    .experience-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }

    .experience-company {
        color: #0ea5e9;
        font-size: 0.95rem;
        margin-bottom: 0.25rem;
    }

    .experience-duration {
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
    }

    .experience-description {
        color: #4b5563;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .project-card {
        background-color: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.2s;
    }

    .project-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-color: #0ea5e9;
    }

    .project-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .project-info {
        padding: 1.25rem;
    }

    .project-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }

    .project-duration {
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
    }

    .project-description {
        color: #4b5563;
        font-size: 0.875rem;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .projects-grid {
            grid-template-columns: 1fr;
        }

        .experience-item {
            padding: 1rem 0;
        }
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .add-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background-color: #0ea5e9;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .add-btn:hover {
        background-color: #0284c7;
    }

    .add-icon {
        width: 1.25rem;
        height: 1.25rem;
    }

    .add-form {
        background-color: #f8fafc;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e5e7eb;
    }

    .skill-tag-container {
        display: inline-flex;
        align-items: center;
    }

    .remove-skill-btn {
        background: none;
        border: none;
        color: #6b7280;
        font-size: 1.25rem;
        padding: 0 0.25rem;
        cursor: pointer;
        transition: color 0.2s;
    }

    .remove-skill-btn:hover {
        color: #ef4444;
    }

    .skill-select {
        width: 100%;
    }

    .show-more-btn {
        display: block;
        width: fit-content;
        margin: 1.5rem auto 0;
        padding: 0.5rem 1.5rem;
        background-color: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        color: #4b5563;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .show-more-btn:hover {
        background-color: #f1f5f9;
        border-color: #0ea5e9;
        color: #0ea5e9;
    }

    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-avatar">
            @if($user->image)
                <img src="{{ asset($user->image) }}" 
                     alt="{{ $user->username }}" 
                     class="profile-image"
                     onerror="this.onerror=null; this.src='{{ asset('images/default-avatar.png') }}'">
            @else
                <div class="profile-image-placeholder">
                    {{ strtoupper(substr($user->username, 0, 1)) }}
                </div>
            @endif
        </div>
        
        <div class="profile-info">
            <div class="profile-header-top">
                <div>
                    <h1 class="profile-name">{{ $user->username }}</h1>
                    <div class="profile-role">{{ $user->role }}</div>
                </div>
                @if(auth()->id() === $user->id)
                    <button onclick="toggleEditForm()" class="edit-profile-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="edit-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit Profile
                    </button>
                @endif
            </div>
            
            <div class="profile-contact">
                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    {{ $user->email }}
                </div>
                @if($user->phone_number)
                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    {{ $user->phone_number }}
                </div>
                @endif
            </div>

            <div id="editProfileForm" class="edit-profile-form" style="display: none;">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="{{ $user->username }}" 
                               class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" 
                               class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" 
                               value="{{ $user->phone_number }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label for="image">Profile Image</label>
                        <input type="file" id="image" name="image" class="form-input" 
                               accept="image/*">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="save-btn">Save Changes</button>
                        <button type="button" onclick="toggleEditForm()" class="cancel-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($user->isConstructor())
        <div class="profile-section">
            <div class="section-header">
                <h2 class="section-title">Skills & Expertise</h2>
                @if(auth()->id() === $user->id)
                    <button onclick="toggleSkillsForm()" class="add-btn">
                        <svg class="add-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Skill
                    </button>
                @endif
            </div>

            <div id="skillsForm" class="add-form" style="display: none;">
                <form method="POST" action="{{ route('skills.store') }}" class="form-content">
                    @csrf
                    <div class="form-group">
                        <label for="skill">Skill</label>
                        <select id="skill" name="skill" class="form-input skill-select">
                            <option value="">Type to search or add new skill...</option>
                            @foreach($allSkills as $skill)
                                <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="save-btn">Add Skill</button>
                        <button type="button" onclick="toggleSkillsForm()" class="cancel-btn">Cancel</button>
                    </div>
                </form>
            </div>

            <div class="skills-list">
                @forelse($user->skills as $skill)
                    <div class="skill-tag-container">
                        <span class="skill-tag">{{ $skill->name }}</span>
                        @if(auth()->id() === $user->id)
                            <form method="POST" action="{{ route('skills.destroy', $skill->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-skill-btn">×</button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">No skills listed yet.</p>
                @endforelse
            </div>
        </div>

        <div class="profile-section">
            <div class="section-header">
                <h2 class="section-title">Experience</h2>
                @if(auth()->id() === $user->id)
                    <button onclick="toggleExperienceForm()" class="add-btn">
                        <svg class="add-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Experience
                    </button>
                @endif
            </div>

            <div id="experienceForm" class="add-form" style="display: none;">
                <form method="POST" action="{{ route('experience.store') }}" class="form-content">
                    @csrf
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" id="role" name="role" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="company_name">Company Name</label>
                        <input type="text" id="company_name" name="company_name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date (Leave empty if current)</label>
                        <input type="date" id="end_date" name="end_date" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-input" rows="3" required></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="save-btn">Add Experience</button>
                        <button type="button" onclick="toggleExperienceForm()" class="cancel-btn">Cancel</button>
                    </div>
                </form>
            </div>

            <div id="experienceList">
                @forelse($user->experience->take(2) as $exp)
                    <div class="experience-item">
                        <h3 class="experience-title">{{ $exp->role }}</h3>
                        <div class="experience-company">{{ $exp->company_name }}</div>
                        <div class="experience-duration">
                            {{ $exp->start_date->format('M Y') }} - 
                            {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Present' }}
                        </div>
                        <p class="experience-description">{{ $exp->description }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">No experience listed yet.</p>
                @endforelse
            </div>

            <div id="experienceListFull" style="display: none;">
                @foreach($user->experience as $exp)
                    <div class="experience-item">
                        <h3 class="experience-title">{{ $exp->role }}</h3>
                        <div class="experience-company">{{ $exp->company_name }}</div>
                        <div class="experience-duration">
                            {{ $exp->start_date->format('M Y') }} - 
                            {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Present' }}
                        </div>
                        <p class="experience-description">{{ $exp->description }}</p>
                    </div>
                @endforeach
            </div>

            @if($user->experience->count() > 2)
                <button onclick="toggleExperience()" id="experienceToggle" class="show-more-btn">
                    Show More
                </button>
            @endif
        </div>

        <div class="profile-section">
            <div class="section-header">
                <h2 class="section-title">Projects</h2>
                @if(auth()->id() === $user->id)
                    <button onclick="toggleProjectForm()" class="add-btn">
                        <svg class="add-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Project
                    </button>
                @endif
            </div>

            <div id="projectForm" class="add-form" style="display: none;">
                <form method="POST" action="/profile/projects" class="form-content" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Project Title</label>
                        <input type="text" id="title" name="title" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="project_image">Project Image</label>
                        <input type="file" id="project_image" name="image" class="form-input" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="project_start_date">Start Date</label>
                        <input type="date" id="project_start_date" name="start_date" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="project_end_date">End Date (Leave empty if ongoing)</label>
                        <input type="date" id="project_end_date" name="end_date" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="project_description">Description</label>
                        <textarea id="project_description" name="description" class="form-input" rows="3" required></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="save-btn">Add Project</button>
                        <button type="button" onclick="toggleProjectForm()" class="cancel-btn">Cancel</button>
                    </div>
                </form>
            </div>

            <div class="projects-grid" id="projectsList">
                @forelse($user->projects->take(3) as $project)
                    <div class="project-card">
                        @if($project->image)
                            <img src="{{ asset($project->image) }}" 
                                 alt="{{ $project->title }}" 
                                 class="project-image"
                                 onerror="this.onerror=null; this.src='{{ asset('images/default-project.png') }}'">
                        @else
                            <img src="{{ asset('images/default-project.png') }}" 
                                 alt="Default project image" 
                                 class="project-image">
                        @endif
                        <div class="project-info">
                            <h3 class="project-title">{{ $project->title }}</h3>
                            <div class="project-duration">
                                {{ $project->start_date->format('M Y') }} - 
                                {{ $project->end_date ? $project->end_date->format('M Y') : 'Present' }}
                            </div>
                            <p class="project-description">{{ $project->description }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No projects listed yet.</p>
                @endforelse
            </div>

            <div class="projects-grid" id="projectsListFull" style="display: none;">
                @foreach($user->projects as $project)
                    <div class="project-card">
                        @if($project->image)
                            <img src="{{ asset($project->image) }}" 
                                 alt="{{ $project->title }}" 
                                 class="project-image"
                                 onerror="this.onerror=null; this.src='{{ asset('images/default-project.png') }}'">
                        @else
                            <img src="{{ asset('images/default-project.png') }}" 
                                 alt="Default project image" 
                                 class="project-image">
                        @endif
                        <div class="project-info">
                            <h3 class="project-title">{{ $project->title }}</h3>
                            <div class="project-duration">
                                {{ $project->start_date->format('M Y') }} - 
                                {{ $project->end_date ? $project->end_date->format('M Y') : 'Present' }}
                            </div>
                            <p class="project-description">{{ $project->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($user->projects->count() > 3)
                <button onclick="toggleProjects()" id="projectsToggle" class="show-more-btn">
                    Show More
                </button>
            @endif
        </div>

        <div class="profile-section">
            <h2 class="section-title">Assigned Works</h2>
            
            <div class="work-grid" id="worksList">
                @forelse($user->works->take(4) as $work)
                    <div class="work-item">
                        <div class="work-header">
                            <h3 class="work-title">{{ $work->title }}</h3>
                            <span class="work-status status-{{ strtolower($work->status) }}">
                                {{ ucfirst($work->status) }}
                            </span>
                        </div>
                        <div class="work-client">
                            Posted by {{ $work->client->username }}
                        </div>
                        <div class="work-description">
                            {{ $work->description }}
                        </div>
                        <div class="work-footer">
                            <div class="work-date">
                                Start date: {{ $work->start_date->format('M d, Y') }}
                            </div>
                            <div class="work-budget">
                                ${{ number_format($work->budget) }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No works assigned yet.</p>
                @endforelse
            </div>

            <div class="work-grid" id="worksListFull" style="display: none;">
                @foreach($user->works as $work)
                    <div class="work-item">
                        <div class="work-header">
                            <h3 class="work-title">{{ $work->title }}</h3>
                            <span class="work-status status-{{ strtolower($work->status) }}">
                                {{ ucfirst($work->status) }}
                            </span>
                        </div>
                        <div class="work-client">
                            Posted by {{ $work->client->username }}
                        </div>
                        <div class="work-description">
                            {{ $work->description }}
                        </div>
                        <div class="work-footer">
                            <div class="work-date">
                                Start date: {{ $work->start_date->format('M d, Y') }}
                            </div>
                            <div class="work-budget">
                                ${{ number_format($work->budget) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($user->works->count() > 4)
                <button onclick="toggleWorks()" id="worksToggle" class="show-more-btn">
                    Show More
                </button>
            @endif
        </div>
    @endif
</div>

<script>
function toggleEditForm() {
    const form = document.getElementById('editProfileForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function toggleSkillsForm() {
    const form = document.getElementById('skillsForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function toggleExperienceForm() {
    const form = document.getElementById('experienceForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function toggleProjectForm() {
    const form = document.getElementById('projectForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

// Initialize select2 for skills
$(document).ready(function() {
    $('.skill-select').select2({
        tags: true,
        createTag: function (params) {
            return {
                id: params.term,
                text: params.term,
                newTag: true
            }
        }
    });
});

function toggleExperience() {
    const listInitial = document.getElementById('experienceList');
    const listFull = document.getElementById('experienceListFull');
    const button = document.getElementById('experienceToggle');
    
    if (listFull.style.display === 'none') {
        listInitial.style.display = 'none';
        listFull.style.display = 'block';
        listFull.classList.add('fade-in');
        button.textContent = 'Show Less';
    } else {
        listInitial.style.display = 'block';
        listFull.style.display = 'none';
        button.textContent = 'Show More';
    }
}

function toggleProjects() {
    const listInitial = document.getElementById('projectsList');
    const listFull = document.getElementById('projectsListFull');
    const button = document.getElementById('projectsToggle');
    
    if (listFull.style.display === 'none') {
        listInitial.style.display = 'none';
        listFull.style.display = 'grid';
        listFull.classList.add('fade-in');
        button.textContent = 'Show Less';
    } else {
        listInitial.style.display = 'grid';
        listFull.style.display = 'none';
        button.textContent = 'Show More';
    }
}

function toggleWorks() {
    const listInitial = document.getElementById('worksList');
    const listFull = document.getElementById('worksListFull');
    const button = document.getElementById('worksToggle');
    
    if (listFull.style.display === 'none') {
        listInitial.style.display = 'none';
        listFull.style.display = 'grid';
        listFull.classList.add('fade-in');
        button.textContent = 'Show Less';
    } else {
        listInitial.style.display = 'grid';
        listFull.style.display = 'none';
        button.textContent = 'Show More';
    }
}
</script>
@endsection 