@extends('layouts.main')

@section('page-title', 'Total Kendaraan')
@section('page-description', 'Daftar semua kendaraan dalam database')

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
                    <h2 class="text-xl font-bold text-gray-800">Total Kendaraan</h2>
                    <p class="text-sm text-gray-500 mt-1">Manage all vehicle data</p>
                </div>
            </div>
            <a href="{{ route('kendaraan.create') }}" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-medium hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                <i class="fas fa-plus"></i>
                <span>Add New Vehicle</span>
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="p-6 border-b border-gray-200 bg-gray-50">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" placeholder="Search vehicles..." class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <option>All Types</option>
                    <option>Mobil</option>
                    <option>Motor</option>
                    <option>Truk</option>
                </select>
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <option>All Status</option>
                    <option>Aktif</option>
                    <option>Breakdown</option>
                    <option>Maintenance</option>
                </select>
            </div>
            <div>
                <button class="w-full px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm font-medium flex items-center justify-center gap-2">
                    <i class="fas fa-filter"></i>
                    <span>Apply Filters</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="border-b border-gray-200">
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">
                        <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    </th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">No. Polisi</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Merk/Type</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Tahun</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Warna</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Status</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">User</th>
                    <th class="text-left text-xs font-semibold text-gray-600 uppercase tracking-wider py-4 px-6">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($kendaraan ?? [] as $item)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="py-4 px-6">
                        <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-car text-blue-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-800">{{ $item->no_polisi }}</div>
                                <div class="text-xs text-gray-500">{{ $item->jenis_kendaraan }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-800">{{ $item->merk }} {{ $item->type }}</td>
                    <td class="py-4 px-6 text-sm text-gray-600">{{ $item->tahun }}</td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            {{ $item->warna }}
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        @if($item->status == 'Aktif')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-circle text-xs mr-1.5"></i>
                            Aktif
                        </span>
                        @elseif($item->status == 'Breakdown')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fas fa-circle text-xs mr-1.5"></i>
                            Breakdown
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-circle text-xs mr-1.5"></i>
                            Maintenance
                        </span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-600">{{ $item->user }}</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('kendaraan.show', $item->id) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors duration-200">
                                <i class="fas fa-eye text-sm"></i>
                            </a>
                            <a href="{{ route('kendaraan.edit', $item->id) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-green-50 text-green-600 hover:bg-green-100 transition-colors duration-200">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <form action="{{ route('kendaraan.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this vehicle?')">
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
                        <i class="fas fa-car text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500 font-medium">No vehicles found</p>
                        <p class="text-sm text-gray-400 mt-2">Start by adding your first vehicle</p>
                        <a href="{{ route('kendaraan.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 mt-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-plus"></i>
                            <span>Add Vehicle</span>
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if(isset($kendaraan) && $kendaraan->hasPages())
    <div class="p-6 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-600">
                Showing {{ $kendaraan->firstItem() }} to {{ $kendaraan->lastItem() }} of {{ $kendaraan->total() }} results
            </div>
            <div class="flex gap-2">
                {{ $kendaraan->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection