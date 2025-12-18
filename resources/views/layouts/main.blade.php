@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <!-- Header -->
        @include('components.header')

        <!-- Success Message -->
        @if(session('success'))
        <div class="mt-6 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg flex items-center justify-between">
            <div class="flex items-center gap-3">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
        <div class="mt-6 bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-lg flex items-center justify-between">
            <div class="flex items-center gap-3">
                <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-red-600 hover:text-red-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        <!-- Page Content -->
        <div class="mt-6">
            @yield('page-content')
        </div>
    </div>
</div>

<!-- Footer -->
@include('components.footer')
@endsection