@extends('layouts.main')

@section('page-title', 'Edit Vehicle')
@section('page-description', 'Update vehicle information')

@section('page-content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center gap-4">
                <a href="{{ route('kendaraan.total') }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </a>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Edit Vehicle</h2>
                    <p class="text-sm text-gray-500 mt-1">Update vehicle information below</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Basic Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-info-circle text-blue-600"></i>
                        Basic Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. Polisi <span class="text-red-500">*</span></label>
                            <input type="text" name="no_polisi" value="{{ old('no_polisi', $kendaraan->no_polisi) }}" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('no_polisi') border-red-500 @enderror" placeholder="e.g., B 1234 XYZ">
                            @error('no_polisi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kendaraan <span class="text-red-500">*</span></label>
                            <select name="jenis_kendaraan" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jenis_kendaraan') border-red-500 @enderror">
                                <option value="">Select Type</option>
                                <option value="Mobil" {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                                <option value="Motor" {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'Motor' ? 'selected' : '' }}>Motor</option>
                                <option value="Truk" {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'Truk' ? 'selected' : '' }}>Truk</option>
                                <option value="Bus" {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) == 'Bus' ? 'selected' : '' }}>Bus</option>
                            </select>
                            @error('jenis_kendaraan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Merk <span class="text-red-500">*</span></label>
                            <input type="text" name="merk" value="{{ old('merk', $kendaraan->merk) }}" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('merk') border-red-500 @enderror" placeholder="e.g., Toyota">
                            @error('merk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type <span class="text-red-500">*</span></label>
                            <input type="text" name="type" value="{{ old('type', $kendaraan->type) }}" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type') border-red-500 @enderror" placeholder="e.g., Avanza">
                            @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun <span class="text-red-500">*</span></label>
                            <input type="number" name="tahun" value="{{ old('tahun', $kendaraan->tahun) }}" required min="1900" max="{{ date('Y') + 1 }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tahun') border-red-500 @enderror" placeholder="e.g., 2020">
                            @error('tahun')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Warna <span class="text-red-500">*</span></label>
                            <input type="text" name="warna" value="{{ old('warna', $kendaraan->warna) }}" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('warna') border-red-500 @enderror" placeholder="e.g., Hitam">
                            @error('warna')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Vehicle Details -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-cog text-blue-600"></i>
                        Vehicle Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. Rangka</label>
                            <input type="text" name="no_rangka" value="{{ old('no_rangka', $kendaraan->no_rangka) }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('no_rangka') border-red-500 @enderror" placeholder="Vehicle chassis number">
                            @error('no_rangka')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. Mesin</label>
                            <input type="text" name="no_mesin" value="{{ old('no_mesin', $kendaraan->no_mesin) }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('no_mesin') border-red-500 @enderror" placeholder="Engine number">
                            @error('no_mesin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                            <select name="status" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                                <option value="">Select Status</option>
                                <option value="Aktif" {{ old('status', $kendaraan->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Breakdown" {{ old('status', $kendaraan->status) == 'Breakdown' ? 'selected' : '' }}>Breakdown</option>
                                <option value="Maintenance" {{ old('status', $kendaraan->status) == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">User</label>
                            <input type="text" name="user" value="{{ old('user', $kendaraan->user) }}" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('user') border-red-500 @enderror" placeholder="Current user">
                            @error('user')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-clipboard text-blue-600"></i>
                        Additional Information
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                            <textarea name="keterangan" rows="4" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('keterangan') border-red-500 @enderror" placeholder="Additional notes about this vehicle">{{ old('keterangan', $kendaraan->keterangan) }}</textarea>
                            @error('keterangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image</label>
                            @if($kendaraan->image)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $kendaraan->image) }}" alt="Current Image" class="max-h-48 rounded-lg border border-gray-200">
                                <p class="text-sm text-gray-500 mt-2">Current image</p>
                            </div>
                            @endif
                            <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 text-center hover:border-blue-500 transition-colors duration-200">
                                <input type="file" name="image" accept="image/*" class="hidden" id="imageUpload" onchange="previewImage(event)">
                                <label for="imageUpload" class="cursor-pointer">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG up to 2MB</p>
                                </label>
                                <div id="imagePreview" class="mt-4 hidden">
                                    <img src="" alt="Preview" class="max-h-48 mx-auto rounded-lg">
                                </div>
                            </div>
                            @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('kendaraan.total') }}" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-medium hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    <span>Update Vehicle</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection