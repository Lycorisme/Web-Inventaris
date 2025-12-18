<?php

namespace App\Http\Controllers;

use App\Models\KendaraanAktif;
use App\Exports\KendaraanAktifExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KendaraanAktifController extends Controller
{
    public function index()
    {
        $kendaraan = KendaraanAktif::paginate(10);
        return view('data.kendaraan.aktif', compact('kendaraan'));
    }

    public function show(KendaraanAktif $kendaraanAktif)
    {
        return response()->json($kendaraanAktif);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_lambung' => 'required|string',
            'tipe_unit' => 'required|string',
            'register_number' => 'required|string',
            'status_komisioning' => 'required|in:aktif,tidak_aktif,maintenance',
        ]);

        KendaraanAktif::create($validated);
        return redirect()->route('kendaraan.aktif')->with('success', 'Data kendaraan berhasil ditambahkan');
    }

    public function update(Request $request, KendaraanAktif $kendaraanAktif)
    {
        $validated = $request->validate([
            'no_lambung' => 'required|string',
            'tipe_unit' => 'required|string',
            'register_number' => 'required|string',
            'status_komisioning' => 'required|in:aktif,tidak_aktif,maintenance',
        ]);

        $kendaraanAktif->update($validated);
        return redirect()->route('kendaraan.aktif')->with('success', 'Data kendaraan berhasil diperbarui');
    }

    public function destroy(KendaraanAktif $kendaraanAktif)
    {
        $kendaraanAktif->delete();
        return redirect()->route('kendaraan.aktif')->with('success', 'Data kendaraan berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new KendaraanAktifExport(), 'Kendaraan_Aktif_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}
