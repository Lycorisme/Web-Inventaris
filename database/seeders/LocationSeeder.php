<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'nama_lokasi' => 'Lantai 1 - Lobby',
                'pic' => 'Andi Wijaya',
                'deskripsi' => 'Area lobby dan resepsionis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Lantai 2 - IT Room',
                'pic' => 'Budi Santoso',
                'deskripsi' => 'Ruang IT dan server',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Lantai 3 - Office',
                'pic' => 'Citra Dewi',
                'deskripsi' => 'Ruang kantor staff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Gudang',
                'pic' => 'Dedi Hermawan',
                'deskripsi' => 'Gudang penyimpanan barang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Parkiran',
                'pic' => 'Eko Prasetyo',
                'deskripsi' => 'Area parkir kendaraan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Mess Senior',
                'pic' => 'Fajar Nugroho',
                'deskripsi' => 'Mess untuk staff senior',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Mess Junior',
                'pic' => 'Gita Pratama',
                'deskripsi' => 'Mess untuk staff junior',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('locations')->insert($locations);
    }
}
