<?php

namespace App\Http\Controllers;

use App\Models\TotalKendaraan;
use App\Models\KendaraanAktif;
use App\Models\UnitBreakdown;
use App\Models\MessSenior;
use App\Models\MessJunior;
use App\Models\MessNonStaff;
use App\Models\AtkItem;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Sistem Lama
        $totalKendaraan = TotalKendaraan::count();
        $kendaraanAktif = KendaraanAktif::count();
        $unitBreakdown = UnitBreakdown::count();
        $messSenior = MessSenior::count();
        $messJunior = MessJunior::count();
        $messNonStaff = MessNonStaff::count();
        $totalMess = $messSenior + $messJunior + $messNonStaff;
        $totalATK = AtkItem::count();

        // Sistem Baru - Inventaris Terpadu
        $totalInventaris = Inventory::count();
        $totalNilaiInventaris = Inventory::sum('total_nilai');
        
        // Inventaris by Kondisi
        $inventarisBarangBaik = Inventory::whereHas('kondisi', function($q) {
            $q->where('nama_kondisi', 'Baik');
        })->count();
        
        $inventarisBarangRusak = Inventory::whereHas('kondisi', function($q) {
            $q->whereIn('nama_kondisi', ['Rusak Ringan', 'Rusak Berat']);
        })->count();

        // Chart Data - Inventaris by Kategori
        $inventarisByKategori = Inventory::select('kategori_id', DB::raw('count(*) as total'))
            ->with('kategori')
            ->groupBy('kategori_id')
            ->get()
            ->map(function($item) {
                return [
                    'kategori' => $item->kategori->nama_kategori,
                    'total' => $item->total
                ];
            });

        // Chart Data - Inventaris by Kondisi
        $inventarisByKondisi = Inventory::select('kondisi_id', DB::raw('count(*) as total'))
            ->with('kondisi')
            ->groupBy('kondisi_id')
            ->get()
            ->map(function($item) {
                return [
                    'kondisi' => $item->kondisi->nama_kondisi,
                    'total' => $item->total,
                    'color' => $item->kondisi->warna_label
                ];
            });

        // Recent Activities
        $recentActivities = ActivityLog::with(['user', 'inventory'])
            ->latest()
            ->take(10)
            ->get();

        // Recent Inventories
        $recentInventories = Inventory::with(['kategori', 'lokasi', 'kondisi'])
            ->latest()
            ->take(5)
            ->get();

        // Top Categories by Value
        $topCategories = Inventory::select('kategori_id', DB::raw('SUM(total_nilai) as total_nilai'))
            ->with('kategori')
            ->groupBy('kategori_id')
            ->orderBy('total_nilai', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            // Sistem Lama
            'totalKendaraan',
            'kendaraanAktif',
            'unitBreakdown',
            'messSenior',
            'messJunior',
            'messNonStaff',
            'totalMess',
            'totalATK',
            // Sistem Baru
            'totalInventaris',
            'totalNilaiInventaris',
            'inventarisBarangBaik',
            'inventarisBarangRusak',
            'inventarisByKategori',
            'inventarisByKondisi',
            'recentActivities',
            'recentInventories',
            'topCategories'
        ));
    }
}
