<?php

namespace App\Http\Controllers;

use App\Models\TotalKendaraan;
use App\Models\KendaraanAktif;
use App\Models\UnitBreakdown;
use App\Models\MessSenior;
use App\Models\MessJunior;
use App\Models\MessNonStaff;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKendaraan = TotalKendaraan::count();
        $kendaraanAktif = KendaraanAktif::count();
        $unitBreakdown = UnitBreakdown::count();
        $messSenior = MessSenior::count();
        $messJunior = MessJunior::count();
        $messNonStaff = MessNonStaff::count();

        return view('dashboard', compact(
            'totalKendaraan',
            'kendaraanAktif',
            'unitBreakdown',
            'messSenior',
            'messJunior',
            'messNonStaff'
        ));
    }
}
