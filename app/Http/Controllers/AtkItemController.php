<?php

namespace App\Http\Controllers;

use App\Models\AtkItem;
use App\Exports\AtkItemExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AtkItemController extends Controller
{
    public function index()
    {
        $items = AtkItem::paginate(10);
        return view('data.atk.items', compact('items'));
    }

    public function show(AtkItem $atkItem)
    {
        return response()->json($atkItem);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'nullable|string',
            'nama_barang' => 'required|string',
            'kategori' => 'required|string',
            'satuan' => 'required|string',
            'stok_awal' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $validated['stok_sekarang'] = $validated['stok_awal'];
        AtkItem::create($validated);

        return redirect()->route('atk.items')->with('success', 'Data ATK berhasil ditambahkan');
    }

    public function update(Request $request, AtkItem $atkItem)
    {
        $validated = $request->validate([
            'kode_barang' => 'nullable|string',
            'nama_barang' => 'required|string',
            'kategori' => 'required|string',
            'satuan' => 'required|string',
            'stok_awal' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $atkItem->update($validated);

        return redirect()->route('atk.items')->with('success', 'Data ATK berhasil diperbarui');
    }

    public function destroy(AtkItem $atkItem)
    {
        $atkItem->delete();

        return redirect()->route('atk.items')->with('success', 'Data ATK berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new AtkItemExport(), 'ATK_Items_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}
