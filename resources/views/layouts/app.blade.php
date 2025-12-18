<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Database General Affair')</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'ui-sans-serif', 'system-ui'],
                    }
                }
            }
        }
    </script>
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
    @yield('content')
    
    @if(session('success'))
    <div id="successAlert" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 flex items-center gap-3">
        <i class="fas fa-check-circle text-xl"></i>
        <span>{{ session('success') }}</span>
    </div>
    <script>
        setTimeout(() => {
            const alert = document.getElementById('successAlert');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateX(100%)';
                alert.style.transition = 'all 0.3s ease';
                setTimeout(() => alert.remove(), 300);
            }
        }, 3000);
    </script>
    @endif
    
    @if(session('error'))
    <div id="errorAlert" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 flex items-center gap-3">
        <i class="fas fa-exclamation-circle text-xl"></i>
        <span>{{ session('error') }}</span>
    </div>
    <script>
        setTimeout(() => {
            const alert = document.getElementById('errorAlert');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateX(100%)';
                alert.style.transition = 'all 0.3s ease';
                setTimeout(() => alert.remove(), 300);
            }
        }, 3000);
    </script>
    @endif
</body>
</html>