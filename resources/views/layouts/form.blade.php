@extends('layouts.app')

@section('content')
<div style="display: flex; min-height: 100vh; background: linear-gradient(135deg, #f0f4f8 0%, #e8f1f8 100%);">
    <div style="width: 100%; max-width: 900px; margin: 40px auto; padding: 0 20px;">
        <div style="background: white; border-radius: 8px; box-shadow: 0 4px 20px rgba(37, 99, 235, 0.12); overflow: hidden;">
            <!-- Header -->
            <div style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); padding: 30px; color: white;">
                <h1 style="font-size: 24px; font-weight: 700; margin: 0;">@yield('form-title', 'Form')</h1>
            </div>

            <!-- Form Content -->
            <div style="padding: 40px;">
                @yield('form-content')
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
@include('components.footer')
@endsection
