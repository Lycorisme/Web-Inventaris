@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px;">
    <div style="width: 100%; max-width: 420px;">
        <!-- Card -->
        <div style="background: white; border-radius: 8px; box-shadow: 0 4px 20px rgba(37, 99, 235, 0.12); padding: 50px 40px;">
            <!-- Logo -->
            <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 40px;">
                <img src="{{ asset('images/logo-ck.jpg') }}" alt="Logo" style="height: 80px; width: auto; object-fit: contain;">
            </div>

            <!-- Title -->
            <h1 style="text-align: center; font-size: 28px; font-weight: 700; color: #1e293b; margin-bottom: 10px;">Welcome Back</h1>
            <p style="text-align: center; color: #64748b; font-size: 14px; margin-bottom: 30px;">Sign in to your account</p>

            @if ($errors->any())
                <div style="background-color: #fee2e2; border: 1px solid #fecaca; border-radius: 6px; padding: 12px 16px; margin-bottom: 20px;">
                    <p style="color: #dc2626; font-size: 13px; font-weight: 600; margin: 0;">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </p>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <!-- Username -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Username</label>
                    <div style="position: relative;">
                        <i class="fas fa-user" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px;"></i>
                        <input type="text" name="username" placeholder="Enter your username" value="{{ old('username') }}" style="width: 100%; padding: 12px 12px 12px 40px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 14px; @if ($errors->has('username')) border-color: #dc2626; @endif" required>
                    </div>
                </div>

                <!-- Password -->
                <div style="margin-bottom: 30px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #334155;">Password</label>
                    <div style="position: relative;">
                        <i class="fas fa-lock" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px;"></i>
                        <input type="password" name="password" id="password" placeholder="Enter your password" style="width: 100%; padding: 12px 45px 12px 40px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 14px;" required>
                        <button type="button" onclick="togglePassword()" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #94a3b8; font-size: 14px; transition: color 0.3s ease;" onmouseover="this.style.color='#2563eb'" onmouseout="this.style.color='#94a3b8'">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Login Button -->
                <button type="submit" style="width: 100%; padding: 12px 24px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; border: none; border-radius: 6px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); margin-bottom: 15px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(37, 99, 235, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(37, 99, 235, 0.3)'">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>

            <!-- Footer -->
            <p style="text-align: center; font-size: 12px; color: #94a3b8; margin-top: 20px;">
                Database General Affair © 2025 | PT. Cipto Kridatama
            </p>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}
</script>
@endsection
