<aside class="w-72 bg-white border-r border-gray-200 shadow-sm flex flex-col h-screen sticky top-0">
    <!-- Logo -->
    <div class="p-6 border-b border-gray-200 flex items-center justify-center">
        <img src="{{ asset('images/logo-ck.jpg') }}" alt="Logo" class="h-16 w-auto object-contain">
    </div>

    <!-- Search -->
    <div class="p-4 border-b border-gray-200">
        <div class="relative">
            <input 
                type="text" 
                id="searchInput" 
                placeholder="Search kendaraan, mess..." 
                class="w-full pl-10 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50"
                onkeyup="performSearch()" 
                autocomplete="off"
            >
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
            <div id="searchResults" class="hidden absolute top-full left-0 right-0 bg-white border border-gray-200 rounded-lg shadow-lg mt-1 max-h-80 overflow-y-auto z-50"></div>
        </div>
    </div>

    <!-- Menu Items -->
    <nav class="flex-1 overflow-y-auto p-4">
        <div class="space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg font-medium text-sm transition-all duration-200 hover:shadow-md">
                <i class="fas fa-chart-line w-5 text-center"></i>
                <span>Dashboard</span>
            </a>

            <!-- Inventaris Terpadu (NEW) -->
            <a href="{{ route('inventory.index') }}" 
               class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-green-600 hover:to-green-700 hover:text-white rounded-lg font-medium text-sm transition-all duration-200 border border-green-200 hover:border-green-600">
                <i class="fas fa-boxes w-5 text-center"></i>
                <span>Inventaris Terpadu</span>
                <span class="ml-auto text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-semibold">NEW</span>
            </a>

            <!-- Data Kendaraan -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <button 
                    onclick="toggleMenu(this)" 
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-gray-50 font-medium text-sm transition-colors duration-200">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-car w-5 text-center"></i>
                        <span>Data Kendaraan</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                </button>
                <div class="hidden bg-gray-50 border-t border-gray-200">
                    <a href="{{ route('kendaraan.total') }}" 
                       class="block px-4 py-2.5 pl-12 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 border-b border-gray-100 transition-colors duration-200">
                        Total Kendaraan
                    </a>
                    <a href="{{ route('kendaraan.aktif') }}" 
                       class="block px-4 py-2.5 pl-12 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 border-b border-gray-100 transition-colors duration-200">
                        Kendaraan Aktif
                    </a>
                    <a href="{{ route('kendaraan.breakdown') }}" 
                       class="block px-4 py-2.5 pl-12 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        Unit Breakdown
                    </a>
                </div>
            </div>

            <!-- Data Mess -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <button 
                    onclick="toggleMenu(this)" 
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-gray-50 font-medium text-sm transition-colors duration-200">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-building w-5 text-center"></i>
                        <span>Data Mess</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                </button>
                <div class="hidden bg-gray-50 border-t border-gray-200">
                    <a href="{{ route('mess.senior') }}" 
                       class="block px-4 py-2.5 pl-12 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 border-b border-gray-100 transition-colors duration-200">
                        Senior Staff
                    </a>
                    <a href="{{ route('mess.junior') }}" 
                       class="block px-4 py-2.5 pl-12 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 border-b border-gray-100 transition-colors duration-200">
                        Junior Staff
                    </a>
                    <a href="{{ route('mess.nonstaff') }}" 
                       class="block px-4 py-2.5 pl-12 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        Non Staff
                    </a>
                </div>
            </div>

            <!-- Data ATK -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <button 
                    onclick="toggleMenu(this)" 
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-gray-50 font-medium text-sm transition-colors duration-200">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-file-alt w-5 text-center"></i>
                        <span>Data ATK</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                </button>
                <div class="hidden bg-gray-50 border-t border-gray-200">
                    <a href="{{ route('atk.items') }}" 
                       class="block px-4 py-2.5 pl-12 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 border-b border-gray-100 transition-colors duration-200">
                        Master ATK
                    </a>
                    <a href="{{ route('atk.transactions') }}" 
                       class="block px-4 py-2.5 pl-12 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        Transaksi ATK
                    </a>
                </div>
            </div>
        </div>
    </nav>
</aside>

<script>
let searchTimeout;

function performSearch() {
    const query = document.getElementById('searchInput').value.trim();
    const resultsContainer = document.getElementById('searchResults');

    if (query.length < 2) {
        resultsContainer.classList.add('hidden');
        return;
    }

    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        fetch(`{{ route('search') }}?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (data.results && data.results.length > 0) {
                    let html = '';
                    data.results.forEach(result => {
                        html += `
                            <a href="${result.url}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition-colors duration-200">
                                <i class="fas ${result.icon} text-blue-600 w-5 text-center"></i>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-semibold text-gray-900 truncate">${result.title}</div>
                                    <div class="text-xs text-gray-500">${result.type}</div>
                                </div>
                            </a>
                        `;
                    });
                    resultsContainer.innerHTML = html;
                    resultsContainer.classList.remove('hidden');
                } else {
                    resultsContainer.innerHTML = '<div class="px-4 py-3 text-center text-gray-500 text-sm">No results found</div>';
                    resultsContainer.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Search error:', error);
                resultsContainer.classList.add('hidden');
            });
    }, 300);
}

function toggleMenu(button) {
    const menu = button.nextElementSibling;
    const chevron = button.querySelector('.fa-chevron-down');
    
    if (menu.classList.contains('hidden')) {
        menu.classList.remove('hidden');
        chevron.style.transform = 'rotate(180deg)';
    } else {
        menu.classList.add('hidden');
        chevron.style.transform = 'rotate(0deg)';
    }
}

// Close search results when clicking outside
document.addEventListener('click', function(e) {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
        searchResults.classList.add('hidden');
    }
});
</script>