@extends('layouts.auth')

@section('content')
<style>
    .auth-container {
        display: flex;
        min-height: 100vh;
    }

    .auth-left {
        flex: 1;
        background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .welcome-text {
        color: white;
        font-size: 2rem;
        font-weight: bold;
        max-width: 400px;
    }

    .auth-right {
        flex: 1;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .auth-form {
        width: 100%;
        max-width: 400px;
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
        color: #1e293b;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        font-size: 0.875rem;
    }

    .form-select {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        font-size: 0.875rem;
        background-color: white;
    }

    .form-button {
        width: 100%;
        padding: 0.75rem;
        background: #0ea5e9;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .form-button:hover {
        background: #0284c7;
    }

    .form-divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1rem 0;
        color: #64748b;
    }

    .form-divider::before,
    .form-divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-divider span {
        padding: 0 0.5rem;
    }

    .form-link {
        display: block;
        text-align: center;
        color: #0ea5e9;
        text-decoration: none;
        font-size: 0.875rem;
    }

    .form-link:hover {
        text-decoration: underline;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
</style>

<div class="auth-container">
    <div class="auth-left">
        <h1 class="welcome-text">
            Join our community of constructors and clients.
        </h1>
    </div>
    <div class="auth-right">
        <div class="auth-form">
            <h2 class="form-title">Create Your Account</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" required autofocus class="form-input" placeholder="Choose a username">
                    @error('username')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="form-input" placeholder="Enter your email">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number') }}" required class="form-input" placeholder="Enter your phone number">
                    @error('phone_number')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <select name="role" required class="form-select">
                        <option value="">Select a role</option>
                        <option value="Constructor" {{ old('role') == 'Constructor' ? 'selected' : '' }}>Constructor</option>
                        <option value="Client" {{ old('role') == 'Client' ? 'selected' : '' }}>Client</option>
                    </select>
                    @error('role')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" required class="form-input" placeholder="Create a password">
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" required class="form-input" placeholder="Confirm your password">
                </div>
                <button type="submit" class="form-button">Create Account</button>
            </form>
            <div class="form-divider">
                <span>or</span>
            </div>
            <a href="{{ route('login') }}" class="form-link">Already have an account? Login</a>
        </div>
    </div>
</div>

<!-- Add SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Error!',
            text: 'Please check the form for errors.',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#0ea5e9'
        });
    });
</script>
@endif
@endsection 