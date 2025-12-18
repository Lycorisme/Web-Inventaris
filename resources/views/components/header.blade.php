<header class="bg-white rounded-xl shadow-sm p-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
        <p class="text-sm text-gray-500 mt-1">@yield('page-description', 'Welcome to Database General Affair')</p>
    </div>
    
    <div class="flex items-center gap-4">
        <!-- Notifications -->
        <div class="relative">
            <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                <i class="fas fa-bell text-xl"></i>
                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
        </div>

        <!-- User Profile -->
        <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
            <div class="text-right">
                <div class="text-sm font-semibold text-gray-800">{{ Auth::user()->name ?? 'Admin User' }}</div>
                <div class="text-xs text-gray-500">{{ Auth::user()->role ?? 'Administrator' }}</div>
            </div>
            <div class="relative">
                <button onclick="toggleUserMenu()" class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 text-white flex items-center justify-center font-semibold hover:shadow-lg transition-all duration-200">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </button>
                
                <!-- Dropdown Menu -->
                <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                    <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-user w-4 text-center"></i>
                        <span>Profile</span>
                    </a>
                    <a href="{{ route('settings') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-cog w-4 text-center"></i>
                        <span>Settings</span>
                    </a>
                    <hr class="my-2 border-gray-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt w-4 text-center"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
function toggleUserMenu() {
    const menu = document.getElementById('userMenu');
    menu.classList.toggle('hidden');
}

// Close user menu when clicking outside
document.addEventListener('click', function(e) {
    const userMenu = document.getElementById('userMenu');
    const userButton = userMenu?.previousElementSibling;
    
    if (userMenu && !userMenu.contains(e.target) && !userButton?.contains(e.target)) {
        userMenu.classList.add('hidden');
    }
});
</script>