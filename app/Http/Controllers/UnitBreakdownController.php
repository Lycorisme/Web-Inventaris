<?php

namespace App\Http\Controllers;

use App\Models\UnitBreakdown;
use App\Exports\UnitBreakdownExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UnitBreakdownController extends Controller
{
    public function index()
    {
        $kendaraan = UnitBreakdown::paginate(10);
        return view('data.kendaraan.breakdown', compact('kendaraan'));
    }

    public function show(UnitBreakdown $unitBreakdown)
    {
        return response()->json($unitBreakdown);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_lambung' => 'required|string',
            'tipe_unit' => 'required|string',
            'register_number' => 'required|string',
            'status_komisioning' => 'required|in:aktif,tidak_aktif,maintenance',
        ]);

        UnitBreakdown::create($validated);
        return redirect()->route('kendaraan.breakdown')->with('success', 'Data kendaraan berhasil ditambahkan');
    }

    public function update(Request $request, UnitBreakdown $unitBreakdown)
    {
        $validated = $request->validate([
            'no_lambung' => 'required|string',
            'tipe_unit' => 'required|string',
            'register_number' => 'required|string',
            'status_komisioning' => 'required|in:aktif,tidak_aktif,maintenance',
        ]);

        $unitBreakdown->update($validated);
        return redirect()->route('kendaraan.breakdown')->with('success', 'Data kendaraan berhasil diperbarui');
    }

    public function destroy(UnitBreakdown $unitBreakdown)
    {
        $unitBreakdown->delete();
        return redirect()->route('kendaraan.breakdown')->with('success', 'Data kendaraan berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new UnitBreakdownExport(), 'Unit_Breakdown_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}
