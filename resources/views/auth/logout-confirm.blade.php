@extends('layouts.app')

@section('title', 'Logout Confirmation')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px;">
    <div style="width: 100%; max-width: 420px;">
        <!-- Card -->
        <div style="background: white; border-radius: 8px; box-shadow: 0 4px 20px rgba(37, 99, 235, 0.12); padding: 50px 40px; text-align: center;">
            <!-- Logo -->
            <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 30px;">
                <img src="{{ asset('images/logo-ck.jpg') }}" alt="Logo" style="height: 70px; width: auto; object-fit: contain;">
            </div>

            <!-- Icon -->
            <div style="font-size: 48px; margin-bottom: 20px; color: #f59e0b;">
                <i class="fas fa-exclamation-circle"></i>
            </div>

            <!-- Title -->
            <h2 style="font-size: 24px; font-weight: 700; color: #1e293b; margin-bottom: 10px;">Are You Sure?</h2>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 30px; line-height: 1.6;">You are about to logout from your account. This action will end your current session.</p>

            <!-- Buttons -->
            <div style="display: flex; gap: 12px; justify-content: center;">
                <a href="{{ route('dashboard') }}" style="flex: 1; padding: 12px 24px; background: white; color: #2563eb; border: 2px solid #2563eb; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
                    <i class="fas fa-times" style="margin-right: 6px;"></i> Cancel
                </a>
                <form method="POST" action="{{ route('logout.store') }}" style="margin: 0; flex: 1;">
                    @csrf
                    <button type="submit" style="width: 100%; padding: 12px 24px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; border: none; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); display: flex; align-items: center; justify-content: center; gap: 6px;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(37, 99, 235, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(37, 99, 235, 0.3)'">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <p style="text-align: center; font-size: 12px; color: #94a3b8; margin-top: 25px;">
                Database General Affair © 2025 | PT. Cipto Kridatama
            </p>
        </div>
    </div>
</div>
@endsection
