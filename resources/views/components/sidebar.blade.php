<div style="width: 280px; background: white; border-right: 1px solid #e2e8f0; padding: 30px 20px; overflow-y: auto; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
    <!-- Logo -->
    <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 40px;">
        <img src="{{ asset('images/logo-ck.jpg') }}" alt="Logo" style="height: 60px; width: auto; object-fit: contain;">
    </div>

    <!-- Search -->
    <div style="margin-bottom: 30px; position: relative;">
        <input type="text" id="searchInput" placeholder="Search kendaraan, mess..." style="width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; background-color: #f8fafc;" onkeyup="performSearch()" autocomplete="off">
        <div id="searchResults" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #e2e8f0; border-top: none; border-radius: 0 0 6px 6px; max-height: 300px; overflow-y: auto; z-index: 100; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        </div>
    </div>

    <!-- Menu Items -->
    <nav style="display: flex; flex-direction: column; gap: 6px;">
        <a href="{{ route('dashboard') }}" style="padding: 12px 16px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 6px; text-align: center; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; gap: 8px;">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>

        <div style="border-radius: 6px; overflow: hidden; border: 1px solid #e2e8f0;">
            <button style="width: 100%; padding: 12px 16px; background: white; border: none; text-align: left; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; justify-content: space-between; align-items: center; color: #334155; transition: all 0.3s ease;" onclick="toggleMenu(this)">
                <span style="display: flex; align-items: center; gap: 8px;"><i class="fas fa-car" style="transition: none;"></i> Data Kendaraan</span>
                <i class="fas fa-chevron-down" style="font-size: 11px; transition: transform 0.3s ease;"></i>
            </button>
            <div style="display: none; background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
                <a href="{{ route('kendaraan.total') }}" style="display: block; padding: 10px 16px; padding-left: 32px; background-color: #f8fafc; text-decoration: none; color: #475569; font-size: 12px; border-bottom: 1px solid #e2e8f0; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#eff6ff'" onmouseout="this.style.backgroundColor='#f8fafc'">Total Kendaraan</a>
                <a href="{{ route('kendaraan.aktif') }}" style="display: block; padding: 10px 16px; padding-left: 32px; background-color: #f8fafc; text-decoration: none; color: #475569; font-size: 12px; border-bottom: 1px solid #e2e8f0; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#eff6ff'" onmouseout="this.style.backgroundColor='#f8fafc'">Kendaraan Aktif</a>
                <a href="{{ route('kendaraan.breakdown') }}" style="display: block; padding: 10px 16px; padding-left: 32px; background-color: #f8fafc; text-decoration: none; color: #475569; font-size: 12px; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#eff6ff'" onmouseout="this.style.backgroundColor='#f8fafc'">Unit Breakdown</a>
            </div>
        </div>

        <div style="border-radius: 6px; overflow: hidden; border: 1px solid #e2e8f0;">
            <button style="width: 100%; padding: 12px 16px; background: white; border: none; text-align: left; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; justify-content: space-between; align-items: center; color: #334155; transition: all 0.3s ease;" onclick="toggleMenu(this)">
                <span style="display: flex; align-items: center; gap: 8px;"><i class="fas fa-building" style="transition: none;"></i> Data Mess</span>
                <i class="fas fa-chevron-down" style="font-size: 11px; transition: transform 0.3s ease;"></i>
            </button>
            <div style="display: none; background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
                <a href="{{ route('mess.senior') }}" style="display: block; padding: 10px 16px; padding-left: 32px; background-color: #f8fafc; text-decoration: none; color: #475569; font-size: 12px; border-bottom: 1px solid #e2e8f0; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#eff6ff'" onmouseout="this.style.backgroundColor='#f8fafc'">Senior Staff</a>
                <a href="{{ route('mess.junior') }}" style="display: block; padding: 10px 16px; padding-left: 32px; background-color: #f8fafc; text-decoration: none; color: #475569; font-size: 12px; border-bottom: 1px solid #e2e8f0; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#eff6ff'" onmouseout="this.style.backgroundColor='#f8fafc'">Junior Staff</a>
                <a href="{{ route('mess.nonstaff') }}" style="display: block; padding: 10px 16px; padding-left: 32px; background-color: #f8fafc; text-decoration: none; color: #475569; font-size: 12px; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#eff6ff'" onmouseout="this.style.backgroundColor='#f8fafc'">Non Staff</a>
            </div>
        </div>

        <div style="border-radius: 6px; overflow: hidden; border: 1px solid #e2e8f0;">
            <button style="width: 100%; padding: 12px 16px; background: white; border: none; text-align: left; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; justify-content: space-between; align-items: center; color: #334155; transition: all 0.3s ease;" onclick="toggleMenu(this)">
                <span style="display: flex; align-items: center; gap: 8px;"><i class="fas fa-file-alt" style="transition: none;"></i> Data ATK</span>
                <i class="fas fa-chevron-down" style="font-size: 11px; transition: transform 0.3s ease;"></i>
            </button>
            <div style="display: none; background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
                <a href="{{ route('atk.items') }}" style="display: block; padding: 10px 16px; padding-left: 32px; background-color: #f8fafc; text-decoration: none; color: #475569; font-size: 12px; border-bottom: 1px solid #e2e8f0; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#eff6ff'" onmouseout="this.style.backgroundColor='#f8fafc'">Master ATK</a>
                <a href="{{ route('atk.transactions') }}" style="display: block; padding: 10px 16px; padding-left: 32px; background-color: #f8fafc; text-decoration: none; color: #475569; font-size: 12px; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#eff6ff'" onmouseout="this.style.backgroundColor='#f8fafc'">Transaksi ATK</a>
            </div>
        </div>
    </nav>
</div>

<script>
let searchTimeout;

function performSearch() {
    const query = document.getElementById('searchInput').value.trim();
    const resultsContainer = document.getElementById('searchResults');

    if (query.length < 2) {
        resultsContainer.style.display = 'none';
        return;
    }

    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        fetch(`{{ route('search') }}?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (data.results.length > 0) {
                    let html = '';
                    data.results.forEach(result => {
                        html += `
                            <a href="${result.url}" style="display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-bottom: 1px solid #e2e8f0; text-decoration: none; color: #334155; transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='#f0f4f8'" onmouseout="this.style.backgroundColor='white'">
                                <i class="fas ${result.icon}" style="color: #2563eb; width: 20px; text-align: center;"></i>
                                <div style="flex: 1; min-width: 0;">
                                    <div style="font-size: 12px; font-weight: 600; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${result.title}</div>
                                    <div style="font-size: 11px; color: #94a3b8;">${result.type}</div>
                                </div>
                            </a>
                        `;
                    });
                    resultsContainer.innerHTML = html;
                    resultsContainer.style.display = 'block';
                } else {
                    resultsContainer.innerHTML = '<div style="padding: 12px 14px; text-align: center; color: #94a3b8; font-size: 12px;">No results found</div>';
                    resultsContainer.style.display = 'block';
                }
            })
            .catch(error => console.error('Search error:', error));
    }, 300);
}

function toggleMenu(button) {
    const menu = button.nextElementSibling;
    const chevron = button.querySelector('.fa-chevron-down');

    if (menu.style.display === 'none' || menu.style.display === '') {
        menu.style.display = 'block';
        chevron.style.transform = 'rotate(180deg)';
    } else {
        menu.style.display = 'none';
        chevron.style.transform = 'rotate(0deg)';
    }
}

// Close search results when clicking outside
document.addEventListener('click', function(e) {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    if (!e.target.closest('[id="searchInput"]') && !e.target.closest('[id="searchResults"]')) {
        searchResults.style.display = 'none';
    }
});
</script>
