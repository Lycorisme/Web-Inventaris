<?php

namespace App\Http\Controllers;

use App\Models\TotalKendaraan;
use App\Exports\TotalKendaraanExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TotalKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraan = TotalKendaraan::paginate(10);
        return view('data.kendaraan.total', compact('kendaraan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(TotalKendaraan $totalKendaraan)
    {
        return response()->json($totalKendaraan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_lambung' => 'required|string',
            'tipe_unit' => 'required|string',
            'register_number' => 'required|string',
            'status_komisioning' => 'required|in:aktif,tidak_aktif,maintenance',
        ]);

        TotalKendaraan::create($validated);

        return redirect()->route('kendaraan.total')->with('success', 'Data kendaraan berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TotalKendaraan $totalKendaraan)
    {
        $validated = $request->validate([
            'no_lambung' => 'required|string',
            'tipe_unit' => 'required|string',
            'register_number' => 'required|string',
            'status_komisioning' => 'required|in:aktif,tidak_aktif,maintenance',
        ]);

        $totalKendaraan->update($validated);

        return redirect()->route('kendaraan.total')->with('success', 'Data kendaraan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TotalKendaraan $totalKendaraan)
    {
        $totalKendaraan->delete();

        return redirect()->route('kendaraan.total')->with('success', 'Data kendaraan berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new TotalKendaraanExport(), 'Total_Kendaraan_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}
