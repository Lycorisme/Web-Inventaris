<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Category;
use App\Models\Location;
use App\Models\Condition;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventory::with(['kategori', 'lokasi', 'kondisi']);

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_barang', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%");
            });
        }

        // Filter by kategori
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter by lokasi
        if ($request->has('lokasi_id') && $request->lokasi_id != '') {
            $query->where('lokasi_id', $request->lokasi_id);
        }

        // Filter by kondisi
        if ($request->has('kondisi_id') && $request->kondisi_id != '') {
            $query->where('kondisi_id', $request->kondisi_id);
        }

        $inventories = $query->latest()->paginate(10);
        $categories = Category::all();
        $locations = Location::all();
        $conditions = Condition::all();

        return view('inventory.index', compact('inventories', 'categories', 'locations', 'conditions'));
    }

    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        $conditions = Condition::all();

        return view('inventory.create', compact('categories', 'locations', 'conditions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'nullable|unique:inventories,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'lokasi_id' => 'required|exists:locations,id',
            'kondisi_id' => 'required|exists:conditions,id',
            'jumlah' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_perolehan' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        $validated['created_by'] = Auth::id();
        $inventory = Inventory::create($validated);

        // Log activity
        ActivityLog::create([
            'inventory_id' => $inventory->id,
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => 'Menambahkan barang baru: ' . $inventory->nama_barang,
            'new_data' => $inventory->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('inventory.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(Inventory $inventory)
    {
        $inventory->load(['kategori', 'lokasi', 'kondisi', 'creator', 'updater', 'activityLogs.user']);
        return response()->json($inventory);
    }

    public function edit(Inventory $inventory)
    {
        $categories = Category::all();
        $locations = Location::all();
        $conditions = Condition::all();

        return view('inventory.edit', compact('inventory', 'categories', 'locations', 'conditions'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'kode_barang' => 'nullable|unique:inventories,kode_barang,' . $inventory->id,
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'lokasi_id' => 'required|exists:locations,id',
            'kondisi_id' => 'required|exists:conditions,id',
            'jumlah' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_perolehan' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        $oldData = $inventory->toArray();
        $validated['updated_by'] = Auth::id();
        $inventory->update($validated);

        // Log activity
        ActivityLog::create([
            'inventory_id' => $inventory->id,
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => 'Mengupdate barang: ' . $inventory->nama_barang,
            'old_data' => $oldData,
            'new_data' => $inventory->fresh()->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('inventory.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Request $request, Inventory $inventory)
    {
        $oldData = $inventory->toArray();
        $namaBarang = $inventory->nama_barang;

        // Log activity before delete
        ActivityLog::create([
            'inventory_id' => $inventory->id,
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => 'Menghapus barang: ' . $namaBarang,
            'old_data' => $oldData,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $inventory->delete();

        return redirect()->route('inventory.index')->with('success', 'Data berhasil dihapus');
    }

    public function export(Request $request)
    {
        $filters = $request->only(['kategori_id', 'lokasi_id', 'kondisi_id', 'search']);
        
        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'export',
            'description' => 'Export data inventaris ke Excel',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $filename = 'inventaris_' . date('Y-m-d_His') . '.xlsx';
        
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\InventoriesExport($filters),
            $filename
        );
    }

    public function importView()
    {
        return view('inventory.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            \Maatwebsite\Excel\Facades\Excel::import(
                new \App\Imports\InventoriesImport,
                $request->file('file')
            );

            // Log activity
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'import',
                'description' => 'Import data inventaris dari Excel: ' . $request->file('file')->getClientOriginalName(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->route('inventory.index')->with('success', 'Data berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal import data: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $filename = 'template_import_inventaris.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\InventoriesExport([]),
            $filename
        );
    }
}
