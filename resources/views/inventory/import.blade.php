@extends('layouts.main')

@section('page-title', 'Import Data Inventaris')
@section('page-description', 'Upload file Excel untuk import data bulk')

@section('page-content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center gap-4">
                <a href="{{ route('inventory.index') }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </a>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Import Data Inventaris</h2>
                    <p class="text-sm text-gray-500 mt-1">Upload file Excel untuk menambahkan data secara bulk</p>
                </div>
            </div>
        </div>

        <!-- Instructions -->
        <div class="p-6 bg-blue-50 border-b border-blue-100">
            <div class="flex items-start gap-3">
                <i class="fas fa-info-circle text-blue-600 text-xl mt-0.5"></i>
                <div>
                    <h3 class="font-semibold text-blue-900 mb-2">Panduan Import:</h3>
                    <ol class="text-sm text-blue-800 space-y-1 list-decimal list-inside">
                        <li>Download template Excel terlebih dahulu</li>
                        <li>Isi data sesuai format yang ada di template</li>
                        <li>Kolom wajib: Nama Barang, Kategori, Lokasi, Kondisi</li>
                        <li>Upload file yang sudah diisi</li>
                        <li>Sistem akan otomatis membuat kategori/lokasi/kondisi baru jika belum ada</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Download Template -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg border border-green-200">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-excel text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Template Import</h4>
                        <p class="text-sm text-gray-600">Download template Excel untuk import data</p>
                    </div>
                </div>
                <a href="{{ route('inventory.template') }}" class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors duration-200 flex items-center gap-2">
                    <i class="fas fa-download"></i>
                    <span>Download Template</span>
                </a>
            </div>
        </div>

        <!-- Upload Form -->
        <form method="POST" action="{{ route('inventory.import.process') }}" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <div class="space-y-6">
                <!-- File Upload -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Upload File Excel <span class="text-red-500">*</span>
                    </label>
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-500 transition-colors duration-200">
                        <input type="file" name="file" id="fileInput" accept=".xlsx,.xls,.csv" required class="hidden" onchange="updateFileName(this)">
                        <label for="fileInput" class="cursor-pointer">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-cloud-upload-alt text-blue-600 text-2xl"></i>
                            </div>
                            <p class="text-gray-700 font-medium mb-1">Klik untuk upload file</p>
                            <p class="text-sm text-gray-500">atau drag & drop file di sini</p>
                            <p class="text-xs text-gray-400 mt-2">Format: .xlsx, .xls, .csv (Max: 2MB)</p>
                        </label>
                        <div id="fileName" class="mt-4 text-sm font-medium text-blue-600 hidden"></div>
                    </div>
                    
                    @error('file')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Format Example -->
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <h4 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="fas fa-table text-gray-600"></i>
                        Contoh Format Data:
                    </h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-3 py-2 text-left">Kode Barang</th>
                                    <th class="px-3 py-2 text-left">Nama Barang</th>
                                    <th class="px-3 py-2 text-left">Kategori</th>
                                    <th class="px-3 py-2 text-left">Lokasi</th>
                                    <th class="px-3 py-2 text-left">Kondisi</th>
                                    <th class="px-3 py-2 text-left">Jumlah</th>
                                    <th class="px-3 py-2 text-left">Harga Satuan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr class="border-t">
                                    <td class="px-3 py-2">ELK-001</td>
                                    <td class="px-3 py-2">Laptop HP</td>
                                    <td class="px-3 py-2">Elektronik</td>
                                    <td class="px-3 py-2">IT Room</td>
                                    <td class="px-3 py-2">Baik</td>
                                    <td class="px-3 py-2">5</td>
                                    <td class="px-3 py-2">5000000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('inventory.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-medium hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-upload"></i>
                    <span>Upload & Import</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function updateFileName(input) {
    const fileName = document.getElementById('fileName');
    if (input.files && input.files[0]) {
        fileName.textContent = '📄 ' + input.files[0].name;
        fileName.classList.remove('hidden');
    }
}

// Drag & Drop
const dropZone = document.querySelector('.border-dashed');
const fileInput = document.getElementById('fileInput');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, () => {
        dropZone.classList.add('border-blue-500', 'bg-blue-50');
    }, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, () => {
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
    }, false);
});

dropZone.addEventListener('drop', (e) => {
    const files = e.dataTransfer.files;
    fileInput.files = files;
    updateFileName(fileInput);
}, false);
</script>
@endsection
