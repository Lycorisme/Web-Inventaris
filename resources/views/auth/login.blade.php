@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- Logo dan Header -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo-ck.jpg') }}" alt="Logo" class="h-20 mx-auto mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
            <p class="mt-2 text-sm text-gray-600">Sign in to Database General Affair</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i>
                <span class="text-sm">{{ session('error') }}</span>
            </div>
            @endif

            @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span class="text-sm">{{ session('success') }}</span>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                            class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                            placeholder="Enter your email"
                        >
                    </div>
                    @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required
                            class="w-full pl-11 pr-12 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                            placeholder="Enter your password"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center"
                        >
                            <i id="toggleIcon" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember" 
                            name="remember" 
                            type="checkbox"
                            {{ old('remember') ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        >
                        <label for="remember" class="ml-2 text-sm text-gray-600">
                            Remember me
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                        Forgot password?
                    </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-medium hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2"
                >
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Sign In</span>
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">or continue with</span>
                    </div>
                </div>

                <!-- Social Login (Optional) -->
                <div class="grid grid-cols-2 gap-3">
                    <button 
                        type="button"
                        class="w-full py-3 border border-gray-200 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center gap-2"
                    >
                        <i class="fab fa-google text-red-500"></i>
                        <span>Google</span>
                    </button>
                    <button 
                        type="button"
                        class="w-full py-3 border border-gray-200 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center gap-2"
                    >
                        <i class="fab fa-microsoft text-blue-500"></i>
                        <span>Microsoft</span>
                    </button>
                </div>
            </form>

            <!-- Register Link -->
            @if (Route::has('register'))
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        Sign up
                    </a>
                </p>
            </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} Database General Affair. All rights reserved.
            </p>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
@endsection