<?php

namespace App\Imports;

use App\Models\Inventory;
use App\Models\Category;
use App\Models\Location;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class InventoriesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Find or create kategori
        $kategori = Category::firstOrCreate(
            ['nama_kategori' => $row['kategori']],
            ['deskripsi' => 'Auto-created from import']
        );

        // Find or create lokasi
        $lokasi = Location::firstOrCreate(
            ['nama_lokasi' => $row['lokasi']],
            ['deskripsi' => 'Auto-created from import']
        );

        // Find or create kondisi
        $kondisi = Condition::firstOrCreate(
            ['nama_kondisi' => $row['kondisi']],
            ['warna_label' => 'info', 'deskripsi' => 'Auto-created from import']
        );

        // Parse tanggal
        $tanggalPerolehan = null;
        if (!empty($row['tanggal_perolehan'])) {
            try {
                $tanggalPerolehan = Carbon::parse($row['tanggal_perolehan']);
            } catch (\Exception $e) {
                $tanggalPerolehan = null;
            }
        }

        return new Inventory([
            'kode_barang' => $row['kode_barang'] ?? null,
            'nama_barang' => $row['nama_barang'],
            'kategori_id' => $kategori->id,
            'lokasi_id' => $lokasi->id,
            'kondisi_id' => $kondisi->id,
            'jumlah' => $row['jumlah'] ?? 0,
            'harga_satuan' => $row['harga_satuan'] ?? 0,
            'tanggal_perolehan' => $tanggalPerolehan,
            'keterangan' => $row['keterangan'] ?? null,
            'created_by' => Auth::id(),
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_barang' => 'required|string',
            'kategori' => 'required|string',
            'lokasi' => 'required|string',
            'kondisi' => 'required|string',
            'jumlah' => 'nullable|numeric|min:0',
            'harga_satuan' => 'nullable|numeric|min:0',
        ];
    }
}
