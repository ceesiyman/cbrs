@extends('layouts.auth')

@section('content')
<style>
.auth-container {
    display: flex;
    min-height: 100vh;
    overflow: hidden;
    perspective: 1000px;
}

.auth-left {
    flex: 1;
    background: linear-gradient(135deg, #1e40af 0%, #60a5fa 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    transform-origin: left center;
    transition: transform 0.8s ease-in-out;
}

.auth-right {
    flex: 1;
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    border-top-left-radius: 30px;
    border-bottom-left-radius: 30px;
    margin-left: -30px;
    position: relative;
    z-index: 1;
    transform-origin: right center;
    transition: transform 0.8s ease-in-out;
    box-shadow: -10px 0 20px rgba(0, 0, 0, 0.1);
}

/* Folding animation classes */
.auth-container.folded .auth-left {
    transform: rotateY(90deg);
}

.auth-container.folded .auth-right {
    transform: rotateY(-90deg);
}

.welcome-text {
    color: white;
    font-size: 2rem;
    font-weight: bold;
    max-width: 400px;
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
    text-align: center;
}

.form-group {
    margin-bottom: 1.5rem;
    position: relative;
}

/* Floating placeholder styles */
.form-input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    font-size: 0.875rem;
    transition: all 0.3s;
}

.form-input:focus {
    border-color: #60a5fa;
    box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.2);
    outline: none;
}

.form-floating-label {
    position: absolute;
    left: 0.75rem;
    top: 0.75rem;
    font-size: 0.875rem;
    color: #94a3b8;
    pointer-events: none;
    transition: 0.3s ease all;
    background: white;
    padding: 0 0.25rem;
}

.form-input:focus ~ .form-floating-label,
.form-input:not(:placeholder-shown) ~ .form-floating-label {
    top: -0.5rem;
    left: 0.5rem;
    font-size: 0.75rem;
    color: #60a5fa;
}

/* Enhanced Neon button styles with moving border */
.neon-button {
    width: 100%;
    padding: 0.75rem;
    background: transparent;
    color: #0ea5e9;
    border: 2px solid #0ea5e9;
    border-radius: 4px;
    font-size: 1rem;
    font-weight: bold;
    letter-spacing: 1px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.3s;
    z-index: 1;
    text-transform: uppercase;
}

.neon-button:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #0ea5e9;
    z-index: -1;
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease;
}

.neon-button:hover {
    color: white;
    box-shadow: 0 0 15px #0ea5e9, 0 0 30px rgba(14, 165, 233, 0.3);
    text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
}

.neon-button:hover:before {
    transform: scaleX(1);
}

/* Moving border animation */
.neon-button::after {
    content: '';
    position: absolute;
    width: 120px;
    height: 2px;
    background: rgba(14, 165, 233, 0.8);
    box-shadow: 0 0 10px #0ea5e9, 0 0 20px #0ea5e9;
    animation: movingBorder 4s linear infinite;
    z-index: 2;
}

@keyframes movingBorder {
    0% {
        top: 0;
        left: -30px;
        width: 120px;
        height: 2px;
    }
    12.5% {
        top: 0;
        left: 100%;
        width: 120px;
        height: 2px;
    }
    12.51% {
        top: 0;
        left: calc(100% - 2px);
        width: 2px;
        height: 120px;
    }
    25% {
        top: 100%;
        left: calc(100% - 2px);
        width: 2px;
        height: 120px;
    }
    25.01% {
        top: calc(100% - 2px);
        left: calc(100% - 30px);
        width: 120px;
        height: 2px;
    }
    37.5% {
        top: calc(100% - 2px);
        left: -2px;
        width: 120px;
        height: 2px;
    }
    37.51% {
        top: calc(100% - 30px);
        left: 0;
        width: 2px;
        height: 120px;
    }
    50% {
        top: 0;
        left: 0;
        width: 2px;
        height: 120px;
    }
    50.01% {
        top: 0;
        left: 0;
        width: 120px;
        height: 2px;
    }
    62.5% {
        top: 0;
        left: 100%;
        width: 120px;
        height: 2px;
    }
    62.51% {
        top: 0;
        left: calc(100% - 2px);
        width: 2px;
        height: 120px;
    }
    75% {
        top: 100%;
        left: calc(100% - 2px);
        width: 2px;
        height: 120px;
    }
    75.01% {
        top: calc(100% - 2px);
        left: calc(100% - 30px);
        width: 120px;
        height: 2px;
    }
    87.5% {
        top: calc(100% - 2px);
        left: -2px;
        width: 120px;
        height: 2px;
    }
    87.51% {
        top: calc(100% - 30px);
        left: 0;
        width: 2px;
        height: 120px;
    }
    100% {
        top: 0;
        left: 0;
        width: 2px;
        height: 120px;
    }
}

.form-divider {
    display: flex;
    align-items: center;
    text-align: center;
    margin: 1.5rem 0;
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
    margin-top: 1rem;
    transition: all 0.3s;
}

.form-link:hover {
    color: #0284c7;
    transform: translateY(-2px);
}

.error-message {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.remember-me {
    display: flex;
    align-items: center;
}

.remember-me input {
    margin-right: 0.5rem;
}

.remember-me span {
    font-size: 0.875rem;
    color: #64748b;
}
</style>

<div class="auth-container" id="authContainer">
    <div class="auth-left">
        <h1 class="welcome-text">
            Welcome to the community where constructors and clients meet.
        </h1>
    </div>
    <div class="auth-right">
        <div class="auth-form">
            <h2 class="form-title">Login To Your Account</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-input" placeholder=" ">
                    <label class="form-floating-label">Email Address</label>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" required class="form-input" placeholder=" ">
                    <label class="form-floating-label">Password</label>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group remember-me">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span>Remember me</span>
                </div>
                <button type="submit" class="neon-button">Login</button>
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

<!-- Animation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add folding animation on page load
        const container = document.getElementById('authContainer');
        container.classList.add('folded');
        
        setTimeout(() => {
            container.classList.remove('folded');
        }, 200);
        
        // Animation for form submission
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const button = document.querySelector('.neon-button');
            button.style.boxShadow = '0 0 25px #0ea5e9, 0 0 50px #0ea5e9';
        });
    });
</script>

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