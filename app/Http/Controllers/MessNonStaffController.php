<?php

namespace App\Http\Controllers;

use App\Models\MessNonStaff;
use App\Exports\MessNonStaffExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MessNonStaffController extends Controller
{
    public function index()
    {
        $mess = MessNonStaff::paginate(10);
        return view('data.mess.nonstaff', compact('mess'));
    }

    public function show(MessNonStaff $messNonStaff)
    {
        return response()->json($messNonStaff);
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

        MessNonStaff::create($validated);
        return redirect()->route('mess.nonstaff')->with('success', 'Data mess berhasil ditambahkan');
    }

    public function update(Request $request, MessNonStaff $messNonStaff)
    {
        $validated = $request->validate([
            'mess' => 'required|string',
            'no_kamar' => 'required|string',
            'sn' => 'required|string',
            'nama_penghuni' => 'required|string',
            'dept' => 'required|string',
            'poh' => 'required|string',
        ]);

        $messNonStaff->update($validated);
        return redirect()->route('mess.nonstaff')->with('success', 'Data mess berhasil diperbarui');
    }

    public function destroy(MessNonStaff $messNonStaff)
    {
        $messNonStaff->delete();
        return redirect()->route('mess.nonstaff')->with('success', 'Data mess berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new MessNonStaffExport(), 'Mess_NonStaff_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}
