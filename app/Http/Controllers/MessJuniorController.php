<?php

namespace App\Http\Controllers;

use App\Models\MessJunior;
use App\Exports\MessJuniorExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MessJuniorController extends Controller
{
    public function index()
    {
        $mess = MessJunior::paginate(10);
        return view('data.mess.junior', compact('mess'));
    }

    public function show(MessJunior $messJunior)
    {
        return response()->json($messJunior);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mess' => 'required|string',
            'no_kamar' => 'required|string',
            'sn' => 'required|string',
            'nama_penghuni' => 'required|string',
            'dept' => 'required|string',
            'poh' => 'required|string',
        ]);

        MessJunior::create($validated);
        return redirect()->route('mess.junior')->with('success', 'Data mess berhasil ditambahkan');
    }

    public function update(Request $request, MessJunior $messJunior)
    {
        $validated = $request->validate([
            'mess' => 'required|string',
            'no_kamar' => 'required|string',
            'sn' => 'required|string',
            'nama_penghuni' => 'required|string',
            'dept' => 'required|string',
            'poh' => 'required|string',
        ]);

        $messJunior->update($validated);
        return redirect()->route('mess.junior')->with('success', 'Data mess berhasil diperbarui');
    }

    public function destroy(MessJunior $messJunior)
    {
        $messJunior->delete();
        return redirect()->route('mess.junior')->with('success', 'Data mess berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new MessJuniorExport(), 'Mess_Junior_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}
