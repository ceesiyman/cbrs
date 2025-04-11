@extends('layouts.app')

@section('content')
<style>
    .works-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .works-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .works-title {
        font-size: 1.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .works-subtitle {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .works-sections {
        display: grid;
        gap: 2rem;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
    }

    .section-count {
        background-color: #f1f5f9;
        color: #475569;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
    }

    .works-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .work-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        transition: all 0.2s;
        cursor: pointer;
        position: relative;
        border: 1px solid #e5e7eb;
    }

    .work-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-color: #0ea5e9;
    }

    .work-card-link {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        pointer-events: none;
    }

    .work-title {
        font-size: 1.25rem;
        font-weight: 500;
        color: #1f2937;
        margin-bottom: 0.75rem;
    }

    .work-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .work-meta-dot {
        width: 3px;
        height: 3px;
        background-color: #d1d5db;
        border-radius: 50%;
    }

    .work-description {
        color: #4b5563;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
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
    }

    .work-status {
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        pointer-events: auto;
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

    .work-budget {
        font-weight: 500;
        color: #1f2937;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: #f8fafc;
        border-radius: 8px;
        color: #6b7280;
        border: 1px solid #e5e7eb;
    }

    .status-dropdown {
        position: relative;
        display: inline-block;
        z-index: 2;
    }

    .status-dropdown-content {
        display: none;
        position: absolute;
        bottom: 100%;
        left: 0;
        background-color: white;
        min-width: 160px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        z-index: 3;
        margin-bottom: 0.5rem;
    }

    .status-dropdown:hover .status-dropdown-content {
        display: block;
    }

    .status-option {
        width: 100%;
        text-align: left;
        border: none;
        background: none;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        color: #4b5563;
        cursor: pointer;
        transition: all 0.2s;
        display: block;
    }

    .status-option:hover {
        background-color: #f3f4f6;
    }

    .status-option:first-child {
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
    }

    .status-option:last-child {
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px;
    }

    .status-form {
        margin: 0;
        padding: 0;
    }

    .hire-request-actions {
        display: flex;
        gap: 0.5rem;
        z-index: 2;
        position: relative;
    }

    .hire-action-btn {
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        border: none;
    }

    .accept-btn {
        background-color: #10b981;
        color: white;
    }

    .decline-btn {
        background-color: #ef4444;
        color: white;
    }

    .hire-status-badge {
        background-color: #fef3c7;
        color: #92400e;
        padding: 0.375rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .works-container {
            margin: 1rem auto;
        }

        .works-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="works-container">
    <div class="works-header">
        <h1 class="works-title">My Works</h1>
        <p class="works-subtitle">
            @if(auth()->user()->isConstructor())
                View your assigned works, hire requests, and client projects
            @else
                Manage your posted projects
            @endif
        </p>
    </div>

    <div class="works-sections">
        @if(auth()->user()->isConstructor())
            <!-- Hire Requests Section -->
            <div class="works-section">
                <div class="section-header">
                    <h2 class="section-title">Hire Requests</h2>
                    <span class="section-count">{{ $hireRequests->count() }}</span>
                </div>
                
                @if($hireRequests->isEmpty())
                    <div class="empty-state">
                        <p>No hire requests at the moment.</p>
                    </div>
                @else
                    <div class="works-grid">
                        @foreach($hireRequests as $work)
                        <div class="work-card" onclick="window.location.href='{{ route('work.show', $work) }}'">
                                <h3 class="work-title">{{ $work->title }}</h3>
                                <div class="work-meta">
                                    Posted by {{ $work->client->username }}
                                    <span class="work-meta-dot"></span>
                                    {{ $work->created_at->diffForHumans() }}
                                </div>
                                <div class="work-description">
                                    {{ $work->description }}
                                </div>
                                <div class="work-footer">
                                    <div class="hire-request-actions" onclick="event.stopPropagation()">
                                        <form method="POST" action="{{ route('work.respond-hire-request', $work) }}" class="status-form">
                                            @csrf
                                            <input type="hidden" name="response" value="accept">
                                            <button type="submit" class="hire-action-btn accept-btn">
                                                Accept
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('work.respond-hire-request', $work) }}" class="status-form">
                                            @csrf
                                            <input type="hidden" name="response" value="decline">
                                            <button type="submit" class="hire-action-btn decline-btn">
                                                Decline
                                            </button>
                                        </form>
                                    </div>
                                    <span class="work-budget">
                                        ${{ number_format($work->budget) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Assigned Works Section -->
            <div class="works-section">
                <div class="section-header">
                    <h2 class="section-title">Assigned to Me</h2>
                    <span class="section-count">{{ $assignedWorks->count() }}</span>
                </div>
                
                @if($assignedWorks->isEmpty())
                    <div class="empty-state">
                        <p>No works assigned to you yet.</p>
                    </div>
                @else
                    <div class="works-grid">
                        @foreach($assignedWorks as $work)
                            <div class="work-card" onclick="window.location.href='{{ route('work.show', $work) }}'">
                                <h3 class="work-title">{{ $work->title }}</h3>
                                <div class="work-meta">
                                    Posted by {{ $work->client->username }}
                                    <span class="work-meta-dot"></span>
                                    {{ $work->created_at->diffForHumans() }}
                                </div>
                                <div class="work-description">
                                    {{ $work->description }}
                                </div>
                                <div class="work-footer">
                                    <div class="status-dropdown" onclick="event.stopPropagation()">
                                        <span class="work-status status-{{ strtolower($work->status) }}">
                                            {{ ucfirst($work->status) }}
                                        </span>
                                        <div class="status-dropdown-content">
                                            @foreach(['pending', 'in-progress', 'completed'] as $status)
                                                @if($status != strtolower($work->status))
                                                    <form method="POST" 
                                                          action="{{ route('work.update-status', $work) }}" 
                                                          class="status-form">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="{{ $status }}">
                                                        <button type="submit" class="status-option">
                                                            {{ ucfirst($status) }}
                                                        </button>
                                                    </form>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <span class="work-budget">
                                        ${{ number_format($work->budget) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        <!-- Client Works Section -->
        <div class="works-section">
            <div class="section-header">
                <h2 class="section-title">
                    @if(auth()->user()->isConstructor())
                        Client Projects
                    @else
                        My Posted Projects
                    @endif
                </h2>
                <span class="section-count">{{ $clientWorks->count() }}</span>
            </div>

            @if($clientWorks->isEmpty())
                <div class="empty-state">
                    @if(auth()->user()->isClient())
                        <p>You haven't posted any projects yet.</p>
                        <a href="{{ route('work.create') }}" class="post-project-btn">Post a new project</a>
                    @else
                        <p>No client projects found.</p>
                    @endif
                </div>
            @else
                <div class="works-grid">
                    @foreach($clientWorks as $work)
                        <div class="work-card" onclick="window.location.href='{{ route('work.show', $work) }}'">
                            <h3 class="work-title">{{ $work->title }}</h3>
                            <div class="work-meta">
                                @if(auth()->user()->isConstructor())
                                    Posted by {{ $work->client->username }}
                                @else
                                    @if($work->constructor)
                                        @if($work->is_hire_request && $work->hire_status == 'pending')
                                            <span class="hire-status-badge">Hire Request Pending</span>
                                        @elseif($work->is_hire_request && $work->hire_status == 'accepted')
                                            Assigned to {{ $work->constructor->username }}
                                        @elseif($work->is_hire_request && $work->hire_status == 'declined')
                                            <span class="hire-status-badge">Hire Request Declined</span>
                                        @else
                                            Assigned to {{ $work->constructor->username }}
                                        @endif
                                    @else
                                        Not assigned
                                    @endif
                                @endif
                                <span class="work-meta-dot"></span>
                                {{ $work->created_at->diffForHumans() }}
                            </div>
                            <div class="work-description">
                                {{ $work->description }}
                            </div>
                            <div class="work-footer">
                                <span class="work-status status-{{ strtolower($work->status) }}">
                                    {{ ucfirst($work->status) }}
                                </span>
                                <span class="work-budget">
                                    ${{ number_format($work->budget) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection