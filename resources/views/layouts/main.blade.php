@extends('layouts.app')

@section('content')
<div style="display: flex; min-height: 100vh; background: linear-gradient(135deg, #f0f4f8 0%, #e8f1f8 100%);">
    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <div style="flex: 1; padding: 30px;">
        <!-- Header -->
        @include('components.header')

        <!-- Page Content -->
        @yield('page-content')
    </div>
</div>

<!-- Footer -->
@include('components.footer')

<script>
function toggleMenu(button) {
    const submenu = button.nextElementSibling;
    submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
    const chevron = button.querySelector('i.fa-chevron-down');
    if (chevron) {
        chevron.style.transform = submenu.style.display === 'none' ? 'rotate(0deg)' : 'rotate(180deg)';
    }
}
</script>
@endsection
