<?php

namespace App\Http\Controllers;

use App\Models\MessSenior;
use App\Exports\MessSeniorExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MessSeniorController extends Controller
{
    public function index()
    {
        $mess = MessSenior::paginate(10);
        return view('data.mess.senior', compact('mess'));
    }

    public function show(MessSenior $messSenior)
    {
        return response()->json($messSenior);
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

        MessSenior::create($validated);
        return redirect()->route('mess.senior')->with('success', 'Data mess berhasil ditambahkan');
    }

    public function update(Request $request, MessSenior $messSenior)
    {
        $validated = $request->validate([
            'mess' => 'required|string',
            'no_kamar' => 'required|string',
            'sn' => 'required|string',
            'nama_penghuni' => 'required|string',
            'dept' => 'required|string',
            'poh' => 'required|string',
        ]);

        $messSenior->update($validated);
        return redirect()->route('mess.senior')->with('success', 'Data mess berhasil diperbarui');
    }

    public function destroy(MessSenior $messSenior)
    {
        $messSenior->delete();
        return redirect()->route('mess.senior')->with('success', 'Data mess berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new MessSeniorExport(), 'Mess_Senior_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}
