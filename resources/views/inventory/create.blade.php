@extends('layouts.main')

@section('page-title', 'Tambah Barang Inventaris')
@section('page-description', 'Tambahkan barang baru ke sistem inventaris')

@section('page-content')
<div class="bg-white rounded-xl shadow-sm">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center gap-4">
            <a href="{{ route('inventory.index') }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left text-gray-600"></i>
            </a>
            <div>
                <h2 class="text-xl font-bold text-gray-800">Tambah Barang Baru</h2>
                <p class="text-sm text-gray-500 mt-1">Isi form di bawah untuk menambahkan barang</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('inventory.store') }}" class="p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kode Barang -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Kode Barang <span class="text-gray-400 font-normal">(Opsional)</span>
                </label>
                <input type="text" name="kode_barang" value="{{ old('kode_barang') }}" 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kode_barang') border-red-500 @enderror"
                    placeholder="Contoh: ELK-001">
                @error('kode_barang')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Barang -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Barang <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_barang') border-red-500 @enderror"
                    placeholder="Contoh: Laptop HP Pavilion">
                @error('nama_barang')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="kategori_id" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kategori_id') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lokasi -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Lokasi <span class="text-red-500">*</span>
                </label>
                <select name="lokasi_id" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('lokasi_id') border-red-500 @enderror">
                    <option value="">Pilih Lokasi</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ old('lokasi_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->nama_lokasi }}
                        </option>
                    @endforeach
                </select>
                @error('lokasi_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kondisi -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Kondisi <span class="text-red-500">*</span>
                </label>
                <select name="kondisi_id" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kondisi_id') border-red-500 @enderror">
                    <option value="">Pilih Kondisi</option>
                    @foreach($conditions as $condition)
                        <option value="{{ $condition->id }}" {{ old('kondisi_id') == $condition->id ? 'selected' : '' }}>
                            {{ $condition->nama_kondisi }}
                        </option>
                    @endforeach
                </select>
                @error('kondisi_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jumlah -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Jumlah <span class="text-red-500">*</span>
                </label>
                <input type="number" name="jumlah" value="{{ old('jumlah', 1) }}" required min="0"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jumlah') border-red-500 @enderror"
                    placeholder="0">
                @error('jumlah')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Harga Satuan -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Harga Satuan (Rp) <span class="text-red-500">*</span>
                </label>
                <input type="number" name="harga_satuan" value="{{ old('harga_satuan', 0) }}" required min="0" step="0.01"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('harga_satuan') border-red-500 @enderror"
                    placeholder="0">
                @error('harga_satuan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Perolehan -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Tanggal Perolehan
                </label>
                <input type="date" name="tanggal_perolehan" value="{{ old('tanggal_perolehan') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tanggal_perolehan') border-red-500 @enderror">
                @error('tanggal_perolehan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Keterangan
                </label>
                <textarea name="keterangan" rows="4"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('keterangan') border-red-500 @enderror"
                    placeholder="Tambahkan keterangan atau catatan tambahan...">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('inventory.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors duration-200">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-medium hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                <i class="fas fa-save"></i>
                <span>Simpan Data</span>
            </button>
        </div>
    </form>
</div>
@endsection
