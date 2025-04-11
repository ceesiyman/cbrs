@extends('layouts.app')

@section('content')
<style>
    /* All existing CSS styles remain unchanged */
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

    .profile-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #f8fafc;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

    .profile-actions {
        display: flex;
        gap: 1rem;
    }

    .action-button {
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }

    .primary-button {
        background-color: #0ea5e9;
        color: white;
    }

    .primary-button:hover {
        background-color: #0284c7;
    }

    .secondary-button {
        background-color: #f8fafc;
        color: #0ea5e9;
        border: 1px solid #0ea5e9;
    }

    .secondary-button:hover {
        background-color: #f0f9ff;
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
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .skills-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .skill-tag {
        background-color: #f0f9ff;
        color: #0ea5e9;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.875rem;
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .project-card {
        background-color: #f8fafc;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.2s;
    }

    .project-card:hover {
        transform: translateY(-2px);
    }

    .project-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .project-info {
        padding: 1rem;
    }

    .project-title {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .project-description {
        color: #64748b;
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .work-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .work-item {
        background-color: white;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
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
        margin-bottom: 0.5rem;
    }

    .work-description {
        color: #4b5563;
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .work-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
    }

    .work-date {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .work-budget {
        font-weight: 500;
        color: #1f2937;
    }

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .profile-contact {
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        .profile-actions {
            justify-content: center;
        }

        .projects-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="profile-container">
    <div class="profile-header">
        <img src="{{ $constructor->image ?? asset('images/default-avatar.png') }}" 
             alt="{{ $constructor->username }}" 
             class="profile-image">
        
        <div class="profile-info">
            <h1 class="profile-name">{{ $constructor->username }}</h1>
            <div class="profile-role">{{ $constructor->role }}</div>
            
            <div class="profile-contact">
                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    {{ $constructor->email }}
                </div>
                @if($constructor->phone_number)
                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    {{ $constructor->phone_number }}
                </div>
                @endif
            </div>

            <div class="profile-actions">
                @auth
                    <a href="{{ route('hire.constructor.form', $constructor) }}" class="action-button primary-button">Hire Now</a>
                @else
                    <a href="{{ route('login') }}?redirect={{ urlencode(route('hire.constructor.form', $constructor)) }}" class="action-button primary-button">Hire Now</a>
                @endauth
                <a href="#" class="action-button secondary-button">Message</a>
            </div>
        </div>
    </div>

    <div class="profile-section">
        <h2 class="section-title">Skills & Expertise</h2>
        <div class="skills-list">
            @forelse($constructor->skills as $skill)
                <span class="skill-tag">{{ $skill->name }}</span>
            @empty
                <p class="text-gray-500">No skills listed yet.</p>
            @endforelse
        </div>
    </div>

    <div class="profile-section">
        <h2 class="section-title">Experience</h2>
        @forelse($constructor->experience as $exp)
            <div class="experience-item mb-6">
                <h3 class="text-lg font-semibold text-gray-900">{{ $exp->role }}</h3>
                <div class="text-blue-600">{{ $exp->company_name }}</div>
                <div class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }} - 
                    {{ $exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : 'Present' }}
                </div>
                <p class="mt-2 text-gray-600">{{ $exp->description }}</p>
            </div>
        @empty
            <p class="text-gray-500">No experience listed yet.</p>
        @endforelse
    </div>

    <div class="profile-section">
        <h2 class="section-title">About</h2>
        <p class="text-gray-600 leading-relaxed">
            Professional constructor with extensive experience in residential and commercial projects.
            Specialized in modern design and sustainable building practices.
        </p>
    </div>

    <div class="profile-section">
        <h2 class="section-title">Recent Projects</h2>
        <div class="projects-grid">
            @forelse($constructor->projects as $project)
                <div class="project-card">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" 
                             alt="{{ $project->title }}" 
                             class="project-image">
                    @endif
                    <div class="project-info">
                        <h3 class="project-title">{{ $project->title }}</h3>
                        <div class="text-sm text-gray-500 mb-2">
                            {{ \Carbon\Carbon::parse($project->start_date)->format('M Y') }} - 
                            {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('M Y') : 'Present' }}
                        </div>
                        <p class="project-description">{{ $project->description }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No projects listed yet.</p>
            @endforelse
        </div>
    </div>

    <div class="profile-section">
        <h2 class="section-title">Assigned Works</h2>
        @if($constructor->works->isEmpty())
            <p class="text-gray-500">No works assigned yet.</p>
        @else
            <div class="work-grid">
                @foreach($constructor->works as $work)
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
        @endif
    </div>
</div>
@endsection