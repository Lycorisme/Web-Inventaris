@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- Logo dan Header -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo-ck.jpg') }}" alt="Logo" class="h-20 mx-auto mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Create Account</h2>
            <p class="mt-2 text-sm text-gray-600">Join Database General Affair today</p>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Full Name
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input 
                            id="name" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus
                            class="w-full pl-11 pr-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                            placeholder="Enter your full name"
                        >
                    </div>
                    @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

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
                            class="w-full pl-11 pr-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                            placeholder="Enter your email"
                        >
                    </div>
                    @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone (Optional) -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Phone Number <span class="text-gray-400 text-xs">(Optional)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                        <input 
                            id="phone" 
                            type="tel" 
                            name="phone" 
                            value="{{ old('phone') }}"
                            class="w-full pl-11 pr-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Enter your phone number"
                        >
                    </div>
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
                            class="w-full pl-11 pr-12 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                            placeholder="Create a password"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password')"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center"
                        >
                            <i id="toggleIconPassword" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required
                            class="w-full pl-11 pr-12 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Confirm your password"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password_confirmation')"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center"
                        >
                            <i id="toggleIconPasswordConfirmation" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                </div>

                <!-- Role Selection -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                        Role
                    </label>
                    <select 
                        id="role" 
                        name="role" 
                        required
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="">Select your role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <input 
                        id="terms" 
                        name="terms" 
                        type="checkbox"
                        required
                        class="w-4 h-4 mt-1 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    >
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        I agree to the 
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Terms and Conditions</a>
                        and 
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Privacy Policy</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-medium hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2"
                >
                    <i class="fas fa-user-plus"></i>
                    <span>Create Account</span>
                </button>

                <!-- Divider -->
                <div class="relative my-5">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">or sign up with</span>
                    </div>
                </div>

                <!-- Social Registration -->
                <div class="grid grid-cols-2 gap-3">
                    <button 
                        type="button"
                        class="w-full py-2.5 border border-gray-200 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center gap-2"
                    >
                        <i class="fab fa-google text-red-500"></i>
                        <span>Google</span>
                    </button>
                    <button 
                        type="button"
                        class="w-full py-2.5 border border-gray-200 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center gap-2"
                    >
                        <i class="fab fa-microsoft text-blue-500"></i>
                        <span>Microsoft</span>
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        Sign in
                    </a>
                </p>
            </div>
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
function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(`toggleIcon${inputId.charAt(0).toUpperCase() + inputId.slice(1).replace('_', '')}`);
    
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