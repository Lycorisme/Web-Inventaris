@extends('layouts.main')

@section('page-title', 'Dashboard')
@section('page-description', 'Overview sistem monitoring general affair')

@section('page-content')
<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-8 mb-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-blue-100">Berikut adalah ringkasan data sistem monitoring general affair Anda</p>
        </div>
        <div class="hidden md:block">
            <div class="text-right">
                <div class="text-sm text-blue-100">{{ now()->format('l, d F Y') }}</div>
                <div class="text-2xl font-bold mt-1">{{ now()->format('H:i') }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards - Sistem Lama -->
<div class="mb-6">
    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        <i class="fas fa-chart-bar text-blue-600"></i>
        Statistik Sistem Existing
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Kendaraan -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-car text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Kendaraan</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalKendaraan }}</h3>
                <p class="text-sm text-gray-500">Total Kendaraan</p>
                <div class="mt-3 flex items-center gap-2 text-xs">
                    <span class="text-green-600 font-semibold">{{ $kendaraanAktif }} Aktif</span>
                    <span class="text-gray-400">•</span>
                    <span class="text-red-600 font-semibold">{{ $unitBreakdown }} Breakdown</span>
                </div>
            </div>
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-3">
                <a href="{{ route('kendaraan.total') }}" class="text-white text-sm font-medium flex items-center justify-between hover:gap-3 transition-all duration-200">
                    <span>Lihat Detail</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Total Mess -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-building text-purple-600 text-xl"></i>
                    </div>
                    <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-3 py-1 rounded-full">Mess</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalMess }}</h3>
                <p class="text-sm text-gray-500">Total Mess</p>
                <div class="mt-3 flex items-center gap-2 text-xs">
                    <span class="text-gray-600">Senior: {{ $messSenior }}</span>
                    <span class="text-gray-400">•</span>
                    <span class="text-gray-600">Junior: {{ $messJunior }}</span>
                </div>
            </div>
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-3">
                <a href="{{ route('mess.senior') }}" class="text-white text-sm font-medium flex items-center justify-between hover:gap-3 transition-all duration-200">
                    <span>Lihat Detail</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Total ATK -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-alt text-orange-600 text-xl"></i>
                    </div>
                    <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-3 py-1 rounded-full">ATK</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalATK }}</h3>
                <p class="text-sm text-gray-500">Total Items ATK</p>
                <div class="mt-3 text-xs text-gray-500">
                    Alat Tulis Kantor
                </div>
            </div>
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-3">
                <a href="{{ route('atk.items') }}" class="text-white text-sm font-medium flex items-center justify-between hover:gap-3 transition-all duration-200">
                    <span>Lihat Detail</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Total Inventaris Terpadu -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden border-2 border-green-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-boxes text-green-600 text-xl"></i>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">NEW</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalInventaris }}</h3>
                <p class="text-sm text-gray-500">Inventaris Terpadu</p>
                <div class="mt-3 flex items-center gap-2 text-xs">
                    <span class="text-green-600 font-semibold">{{ $inventarisBarangBaik }} Baik</span>
                    <span class="text-gray-400">•</span>
                    <span class="text-red-600 font-semibold">{{ $inventarisBarangRusak }} Rusak</span>
                </div>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-3">
                <a href="{{ route('inventory.index') }}" class="text-white text-sm font-medium flex items-center justify-between hover:gap-3 transition-all duration-200">
                    <span>Lihat Detail</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Inventaris Terpadu Section -->
<div class="mb-6">
    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        <i class="fas fa-boxes text-green-600"></i>
        Inventaris Terpadu - Overview
    </h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Total Nilai -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-2xl"></i>
                </div>
                <i class="fas fa-chart-line text-3xl opacity-20"></i>
            </div>
            <h3 class="text-sm font-medium mb-2 opacity-90">Total Nilai Aset</h3>
            <p class="text-3xl font-bold">Rp {{ number_format($totalNilaiInventaris ?? 0, 0, ',', '.') }}</p>
            <div class="mt-4 pt-4 border-t border-white border-opacity-20">
                <p class="text-sm opacity-75">{{ $totalInventaris }} item terdaftar</p>
            </div>
        </div>

        <!-- Chart - By Kategori -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Distribusi per Kategori</h3>
            @if($inventarisByKategori->count() > 0)
                <canvas id="chartKategori" height="200"></canvas>
            @else
                <div class="flex items-center justify-center h-48">
                    <div class="text-center">
                        <i class="fas fa-chart-pie text-gray-300 text-4xl mb-3"></i>
                        <p class="text-sm text-gray-500">Belum ada data</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Chart - By Kondisi -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Status Kondisi</h3>
            @if($inventarisByKondisi->count() > 0)
                <canvas id="chartKondisi" height="200"></canvas>
            @else
                <div class="flex items-center justify-center h-48">
                    <div class="text-center">
                        <i class="fas fa-chart-pie text-gray-300 text-4xl mb-3"></i>
                        <p class="text-sm text-gray-500">Belum ada data</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Recent Activities & Top Categories -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Recent Activities -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-history text-blue-600"></i>
                Aktivitas Terbaru
            </h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($recentActivities as $activity)
                <div class="flex items-start gap-4 pb-4 border-b border-gray-100 last:border-0">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                        @if($activity->action == 'create')
                            <i class="fas fa-plus text-blue-600"></i>
                        @elseif($activity->action == 'update')
                            <i class="fas fa-edit text-green-600"></i>
                        @elseif($activity->action == 'delete')
                            <i class="fas fa-trash text-red-600"></i>
                        @elseif($activity->action == 'export')
                            <i class="fas fa-download text-purple-600"></i>
                        @else
                            <i class="fas fa-upload text-orange-600"></i>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800">{{ $activity->description }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $activity->user->name ?? 'System' }} • {{ $activity->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                    <p class="text-sm text-gray-500">Belum ada aktivitas</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Top Categories by Value -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-trophy text-yellow-500"></i>
                Top Kategori (by Nilai)
            </h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($topCategories as $index => $cat)
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                        {{ $index + 1 }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-semibold text-gray-800">{{ $cat->kategori->nama_kategori }}</span>
                            <span class="text-sm font-bold text-green-600">Rp {{ number_format($cat->total_nilai, 0, ',', '.') }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full" style="width: {{ $totalNilaiInventaris > 0 ? ($cat->total_nilai / $totalNilaiInventaris) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-box-open text-gray-300 text-4xl mb-3"></i>
                    <p class="text-sm text-gray-500">Belum ada data</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Recent Inventories -->
<div class="bg-white rounded-xl shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-clock text-blue-600"></i>
                Barang Terbaru Ditambahkan
            </h3>
            <a href="{{ route('inventory.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                Lihat Semua →
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="border-b border-gray-200">
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-3 px-6">Kode</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-3 px-6">Nama Barang</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-3 px-6">Kategori</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-3 px-6">Lokasi</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-3 px-6">Kondisi</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-3 px-6">Total Nilai</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recentInventories as $item)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="py-4 px-6 text-sm font-medium text-gray-800">{{ $item->kode_barang ?? '-' }}</td>
                    <td class="py-4 px-6 text-sm font-semibold text-gray-800">{{ $item->nama_barang }}</td>
                    <td class="py-4 px-6 text-sm text-gray-600">{{ $item->kategori->nama_kategori }}</td>
                    <td class="py-4 px-6 text-sm text-gray-600">{{ $item->lokasi->nama_lokasi }}</td>
                    <td class="py-4 px-6">
                        @php
                            $colors = [
                                'success' => 'bg-green-100 text-green-800',
                                'warning' => 'bg-yellow-100 text-yellow-800',
                                'danger' => 'bg-red-100 text-red-800',
                                'info' => 'bg-blue-100 text-blue-800',
                            ];
                            $colorClass = $colors[$item->kondisi->warna_label] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $colorClass }}">
                            {{ $item->kondisi->nama_kondisi }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-sm font-bold text-green-600">Rp {{ number_format($item->total_nilai, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center">
                        <i class="fas fa-box-open text-gray-300 text-4xl mb-3"></i>
                        <p class="text-sm text-gray-500">Belum ada data inventaris</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart Kategori
    const chartKategoriEl = document.getElementById('chartKategori');
    if (chartKategoriEl) {
        const ctxKategori = chartKategoriEl.getContext('2d');
        new Chart(ctxKategori, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($inventarisByKategori->pluck('kategori')) !!},
                datasets: [{
                    data: {!! json_encode($inventarisByKategori->pluck('total')) !!},
                    backgroundColor: [
                        '#3B82F6', '#8B5CF6', '#EC4899', '#F59E0B', '#10B981', '#6B7280'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: { size: 11 }
                        }
                    }
                }
            }
        });
    }

    // Chart Kondisi
    const chartKondisiEl = document.getElementById('chartKondisi');
    if (chartKondisiEl) {
        const ctxKondisi = chartKondisiEl.getContext('2d');
        const kondisiData = {!! json_encode($inventarisByKondisi) !!};
        const kondisiColors = {
            'success': '#10B981',
            'warning': '#F59E0B',
            'danger': '#EF4444',
            'info': '#3B82F6'
        };
        const kondisiBackgroundColors = kondisiData.map(item => kondisiColors[item.color] || '#6B7280');

        new Chart(ctxKondisi, {
            type: 'pie',
            data: {
                labels: kondisiData.map(item => item.kondisi),
                datasets: [{
                    data: kondisiData.map(item => item.total),
                    backgroundColor: kondisiBackgroundColors,
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: { size: 11 }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection
