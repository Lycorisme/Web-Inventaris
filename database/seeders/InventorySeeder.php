<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $inventories = [
            [
                'kode_barang' => 'ELK-001',
                'nama_barang' => 'Laptop HP Pavilion 14',
                'kategori_id' => 1, // Elektronik
                'lokasi_id' => 2, // IT Room
                'kondisi_id' => 1, // Baik
                'jumlah' => 5,
                'harga_satuan' => 5000000,
                'total_nilai' => 25000000,
                'tanggal_perolehan' => Carbon::parse('2024-01-15'),
                'keterangan' => 'Laptop untuk staff IT',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'FRN-001',
                'nama_barang' => 'Meja Kantor Kayu Jati',
                'kategori_id' => 2, // Furniture
                'lokasi_id' => 3, // Office
                'kondisi_id' => 1, // Baik
                'jumlah' => 10,
                'harga_satuan' => 1500000,
                'total_nilai' => 15000000,
                'tanggal_perolehan' => Carbon::parse('2024-02-20'),
                'keterangan' => 'Meja untuk staff kantor',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'ELK-002',
                'nama_barang' => 'Printer Canon LBP 6030',
                'kategori_id' => 1, // Elektronik
                'lokasi_id' => 3, // Office
                'kondisi_id' => 2, // Rusak Ringan
                'jumlah' => 3,
                'harga_satuan' => 1200000,
                'total_nilai' => 3600000,
                'tanggal_perolehan' => Carbon::parse('2023-11-10'),
                'keterangan' => 'Printer rusak ringan, perlu maintenance',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'VHC-001',
                'nama_barang' => 'Motor Honda Beat 2023',
                'kategori_id' => 3, // Kendaraan
                'lokasi_id' => 5, // Parkiran
                'kondisi_id' => 1, // Baik
                'jumlah' => 2,
                'harga_satuan' => 18000000,
                'total_nilai' => 36000000,
                'tanggal_perolehan' => Carbon::parse('2023-06-15'),
                'keterangan' => 'Motor dinas operasional',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'FRN-002',
                'nama_barang' => 'Kursi Kantor Putar',
                'kategori_id' => 2, // Furniture
                'lokasi_id' => 3, // Office
                'kondisi_id' => 3, // Rusak Berat
                'jumlah' => 20,
                'harga_satuan' => 500000,
                'total_nilai' => 10000000,
                'tanggal_perolehan' => Carbon::parse('2022-08-20'),
                'keterangan' => 'Beberapa kursi kaki patah, perlu penggantian',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'ATK-001',
                'nama_barang' => 'Pulpen Pilot',
                'kategori_id' => 4, // ATK
                'lokasi_id' => 4, // Gudang
                'kondisi_id' => 1, // Baik
                'jumlah' => 100,
                'harga_satuan' => 5000,
                'total_nilai' => 500000,
                'tanggal_perolehan' => Carbon::parse('2024-12-01'),
                'keterangan' => 'Stok ATK untuk kantor',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('inventories')->insert($inventories);
    }
}
