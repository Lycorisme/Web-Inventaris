<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Elektronik',
                'deskripsi' => 'Barang elektronik seperti laptop, printer, proyektor, dll',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Furniture',
                'deskripsi' => 'Meja, kursi, lemari, rak, dll',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Kendaraan',
                'deskripsi' => 'Motor, mobil, sepeda, dll',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Alat Tulis Kantor (ATK)',
                'deskripsi' => 'ATK, kertas, pulpen, dll',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Mess & Penginapan',
                'deskripsi' => 'Fasilitas mess dan penginapan karyawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Lain-lain',
                'deskripsi' => 'Barang yang tidak termasuk kategori di atas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
