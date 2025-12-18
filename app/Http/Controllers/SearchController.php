<?php

namespace App\Http\Controllers;

use App\Models\TotalKendaraan;
use App\Models\KendaraanAktif;
use App\Models\UnitBreakdown;
use App\Models\MessSenior;
use App\Models\MessJunior;
use App\Models\MessNonStaff;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json(['results' => []]);
        }

        $results = [];

        // Search in Kendaraan tables
        $totalKendaraan = TotalKendaraan::where('no_lambung', 'like', "%{$query}%")
            ->orWhere('tipe_unit', 'like', "%{$query}%")
            ->orWhere('register_number', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($totalKendaraan as $item) {
            $results[] = [
                'type' => 'Total Kendaraan',
                'title' => $item->no_lambung,
                'subtitle' => $item->tipe_unit,
                'url' => route('kendaraan.total'),
                'icon' => 'fa-car'
            ];
        }

        $kendaraanAktif = KendaraanAktif::where('no_lambung', 'like', "%{$query}%")
            ->orWhere('tipe_unit', 'like', "%{$query}%")
            ->orWhere('register_number', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($kendaraanAktif as $item) {
            $results[] = [
                'type' => 'Kendaraan Aktif',
                'title' => $item->no_lambung,
                'subtitle' => $item->tipe_unit,
                'url' => route('kendaraan.aktif'),
                'icon' => 'fa-check-circle'
            ];
        }

        $unitBreakdown = UnitBreakdown::where('no_lambung', 'like', "%{$query}%")
            ->orWhere('tipe_unit', 'like', "%{$query}%")
            ->orWhere('register_number', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($unitBreakdown as $item) {
            $results[] = [
                'type' => 'Unit Breakdown',
                'title' => $item->no_lambung,
                'subtitle' => $item->tipe_unit,
                'url' => route('kendaraan.breakdown'),
                'icon' => 'fa-tools'
            ];
        }

        // Search in Mess tables
        $messSenior = MessSenior::where('nama_penghuni', 'like', "%{$query}%")
            ->orWhere('sn', 'like', "%{$query}%")
            ->orWhere('dept', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($messSenior as $item) {
            $results[] = [
                'type' => 'Senior Staff',
                'title' => $item->nama_penghuni,
                'subtitle' => 'Kamar ' . $item->no_kamar,
                'url' => route('mess.senior'),
                'icon' => 'fa-user-tie'
            ];
        }

        $messJunior = MessJunior::where('nama_penghuni', 'like', "%{$query}%")
            ->orWhere('sn', 'like', "%{$query}%")
            ->orWhere('dept', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($messJunior as $item) {
            $results[] = [
                'type' => 'Junior Staff',
                'title' => $item->nama_penghuni,
                'subtitle' => 'Kamar ' . $item->no_kamar,
                'url' => route('mess.junior'),
                'icon' => 'fa-user'
            ];
        }

        $messNonStaff = MessNonStaff::where('nama_penghuni', 'like', "%{$query}%")
            ->orWhere('sn', 'like', "%{$query}%")
            ->orWhere('dept', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($messNonStaff as $item) {
            $results[] = [
                'type' => 'Non Staff',
                'title' => $item->nama_penghuni,
                'subtitle' => 'Kamar ' . $item->no_kamar,
                'url' => route('mess.nonstaff'),
                'icon' => 'fa-users'
            ];
        }

        return response()->json(['results' => array_slice($results, 0, 10)]);
    }
}
