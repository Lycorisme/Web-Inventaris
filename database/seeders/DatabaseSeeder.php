<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan seeder penting! (Foreign key dependency)
        $this->call([
            CategorySeeder::class,    // 1. Kategori
            LocationSeeder::class,    // 2. Lokasi
            ConditionSeeder::class,   // 3. Kondisi
            InventorySeeder::class,   // 4. Inventaris (terakhir karena depend on all)
        ]);
    }
}
