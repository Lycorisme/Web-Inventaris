<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
    public function run(): void
    {
        $conditions = [
            [
                'nama_kondisi' => 'Baik',
                'warna_label' => 'success',
                'deskripsi' => 'Kondisi barang masih bagus dan berfungsi normal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kondisi' => 'Rusak Ringan',
                'warna_label' => 'warning',
                'deskripsi' => 'Ada kerusakan kecil tapi masih bisa digunakan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kondisi' => 'Rusak Berat',
                'warna_label' => 'danger',
                'deskripsi' => 'Kerusakan parah, perlu perbaikan atau penggantian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kondisi' => 'Hilang',
                'warna_label' => 'danger',
                'deskripsi' => 'Barang tidak ditemukan atau hilang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kondisi' => 'Maintenance',
                'warna_label' => 'info',
                'deskripsi' => 'Sedang dalam proses perawatan atau perbaikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('conditions')->insert($conditions);
    }
}
