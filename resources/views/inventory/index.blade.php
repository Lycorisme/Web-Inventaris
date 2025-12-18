@extends('layouts.main')

@section('page-title', 'Sistem Inventaris Terpadu')
@section('page-description', 'Kelola semua aset dalam satu sistem')

@section('page-content')
<div class="bg-white rounded-xl shadow-sm">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </a>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Inventaris Terpadu</h2>
                    <p class="text-sm text-gray-500 mt-1">Kelola semua aset dalam satu database</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('inventory.create') }}" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-medium hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Barang</span>
                </a>
                <a href="{{ route('inventory.import') }}" class="px-6 py-2.5 bg-white border-2 border-purple-600 text-purple-600 rounded-lg font-medium hover:bg-purple-50 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-upload"></i>
                    <span>Import Excel</span>
                </a>
                <a href="{{ route('inventory.export', request()->all()) }}" class="px-6 py-2.5 bg-white border-2 border-green-600 text-green-600 rounded-lg font-medium hover:bg-green-50 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-download"></i>
                    <span>Export Excel</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="p-6 border-b border-gray-200 bg-gray-50">
        <form method="GET" action="{{ route('inventory.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..." class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div>
                    <select name="kategori_id" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('kategori_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="lokasi_id" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <option value="">Semua Lokasi</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ request('lokasi_id') == $location->id ? 'selected' : '' }}>
                                {{ $location->nama_lokasi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="kondisi_id" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <option value="">Semua Kondisi</option>
                        @foreach($conditions as $condition)
                            <option value="{{ $condition->id }}" {{ request('kondisi_id') == $condition->id ? 'selected' : '' }}>
                                {{ $condition->nama_kondisi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm font-medium flex items-center justify-center gap-2">
                        <i class="fas fa-search"></i>
                        <span>Filter</span>
                    </button>
                    <a href="{{ route('inventory.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 text-sm font-medium">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Stats Summary -->
    <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <div class="text-sm text-gray-600">Total Barang</div>
                <div class="text-2xl font-bold text-gray-800">{{ $inventories->total() }}</div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <div class="text-sm text-gray-600">Total Nilai</div>
                <div class="text-2xl font-bold text-green-600">Rp {{ number_format(\App\Models\Inventory::sum('total_nilai'), 0, ',', '.') }}</div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <div class="text-sm text-gray-600">Kategori</div>
                <div class="text-2xl font-bold text-blue-600">{{ $categories->count() }}</div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <div class="text-sm text-gray-600">Lokasi</div>
                <div class="text-2xl font-bold text-purple-600">{{ $locations->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="border-b border-gray-200">
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Kode</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Nama Barang</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Kategori</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Lokasi</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Kondisi</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Jumlah</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Total Nilai</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($inventories as $item)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="py-4 px-6">
                        <div class="text-sm font-semibold text-gray-800">{{ $item->kode_barang ?? '-' }}</div>
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-sm font-semibold text-gray-800">{{ $item->nama_barang }}</div>
                        <div class="text-xs text-gray-500">{{ $item->tanggal_perolehan ? $item->tanggal_perolehan->format('d M Y') : '-' }}</div>
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-800">{{ $item->kategori->nama_kategori }}</td>
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
                    <td class="py-4 px-6 text-sm font-semibold text-gray-800">{{ $item->jumlah }}</td>
                    <td class="py-4 px-6 text-sm font-semibold text-green-600">Rp {{ number_format($item->total_nilai, 0, ',', '.') }}</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-2">
                            <button onclick="viewDetail({{ $item->id }})" class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors duration-200">
                                <i class="fas fa-eye text-sm"></i>
                            </button>
                            <a href="{{ route('inventory.edit', $item->id) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-green-50 text-green-600 hover:bg-green-100 transition-colors duration-200">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors duration-200">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-12 text-center">
                        <i class="fas fa-box-open text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500 font-medium">Belum ada data inventaris</p>
                        <p class="text-sm text-gray-400 mt-2">Mulai dengan menambahkan barang pertama</p>
                        <a href="{{ route('inventory.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 mt-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Barang</span>
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($inventories->hasPages())
    <div class="p-6 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-600">
                Menampilkan {{ $inventories->firstItem() }} - {{ $inventories->lastItem() }} dari {{ $inventories->total() }} data
            </div>
            <div class="flex gap-2">
                {{ $inventories->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<script>
function viewDetail(id) {
    fetch(`/inventory/${id}`)
        .then(response => response.json())
        .then(data => {
            alert('Detail View - Coming Soon!\n\nBarang: ' + data.nama_barang);
        });
}
</script>
@endsection
