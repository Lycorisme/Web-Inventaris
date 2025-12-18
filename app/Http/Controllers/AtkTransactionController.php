<?php

namespace App\Http\Controllers;

use App\Models\AtkItem;
use App\Models\AtkTransaction;
use App\Exports\AtkTransactionExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AtkTransactionController extends Controller
{
    public function index()
    {
        $transactions = AtkTransaction::with('atkItem')->orderBy('tanggal_transaksi', 'desc')->paginate(10);
        return view('data.atk.transactions', compact('transactions'));
    }

    public function show(AtkTransaction $atkTransaction)
    {
        return response()->json($atkTransaction->load('atkItem'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'atk_item_id' => 'required|exists:atk_items,id',
            'tipe_transaksi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'tanggal_transaksi' => 'required|date',
        ]);

        $atkItem = AtkItem::find($validated['atk_item_id']);

        if ($validated['tipe_transaksi'] === 'keluar' && $atkItem->stok_sekarang < $validated['jumlah']) {
            return back()->withErrors(['jumlah' => 'Stok tidak cukup']);
        }

        AtkTransaction::create($validated);

        // Update stok
        if ($validated['tipe_transaksi'] === 'masuk') {
            $atkItem->increment('stok_sekarang', $validated['jumlah']);
        } else {
            $atkItem->decrement('stok_sekarang', $validated['jumlah']);
        }

        return redirect()->route('atk.transactions')->with('success', 'Transaksi ATK berhasil ditambahkan');
    }

    public function update(Request $request, AtkTransaction $atkTransaction)
    {
        $validated = $request->validate([
            'atk_item_id' => 'required|exists:atk_items,id',
            'tipe_transaksi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'tanggal_transaksi' => 'required|date',
        ]);

        // Revert old transaction
        $oldItem = $atkTransaction->atkItem;
        if ($atkTransaction->tipe_transaksi === 'masuk') {
            $oldItem->decrement('stok_sekarang', $atkTransaction->jumlah);
        } else {
            $oldItem->increment('stok_sekarang', $atkTransaction->jumlah);
        }

        // Apply new transaction
        $newItem = AtkItem::find($validated['atk_item_id']);
        if ($validated['tipe_transaksi'] === 'keluar' && $newItem->stok_sekarang < $validated['jumlah']) {
            return back()->withErrors(['jumlah' => 'Stok tidak cukup']);
        }

        if ($validated['tipe_transaksi'] === 'masuk') {
            $newItem->increment('stok_sekarang', $validated['jumlah']);
        } else {
            $newItem->decrement('stok_sekarang', $validated['jumlah']);
        }

        $atkTransaction->update($validated);

        return redirect()->route('atk.transactions')->with('success', 'Transaksi ATK berhasil diperbarui');
    }

    public function destroy(AtkTransaction $atkTransaction)
    {
        $atkItem = $atkTransaction->atkItem;

        // Revert transaction
        if ($atkTransaction->tipe_transaksi === 'masuk') {
            $atkItem->decrement('stok_sekarang', $atkTransaction->jumlah);
        } else {
            $atkItem->increment('stok_sekarang', $atkTransaction->jumlah);
        }

        $atkTransaction->delete();

        return redirect()->route('atk.transactions')->with('success', 'Transaksi ATK berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new AtkTransactionExport(), 'ATK_Transactions_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}
