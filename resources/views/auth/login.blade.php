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
            Welcome to the community where constructors and clients meets.
        </h1>
    </div>
    <div class="auth-right">
        <div class="auth-form">
            <h2 class="form-title">Login To Your Account</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-input" placeholder="Enter your email">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" required class="form-input" placeholder="Enter your password">
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>
                <button type="submit" class="form-button">Login</button>
            </form>
            <div class="form-divider">
                <span>or</span>
            </div>
            <a href="{{ route('register') }}" class="form-link">Create Account</a>
        </div>
    </div>
</div>

<!-- Add SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#0ea5e9',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    });
</script>
@endif

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