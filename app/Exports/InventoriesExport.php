<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventoriesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Inventory::with(['kategori', 'lokasi', 'kondisi', 'creator']);

        // Apply filters
        if (!empty($this->filters['kategori_id'])) {
            $query->where('kategori_id', $this->filters['kategori_id']);
        }

        if (!empty($this->filters['lokasi_id'])) {
            $query->where('lokasi_id', $this->filters['lokasi_id']);
        }

        if (!empty($this->filters['kondisi_id'])) {
            $query->where('kondisi_id', $this->filters['kondisi_id']);
        }

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('kode_barang', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%");
            });
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Barang',
            'Nama Barang',
            'Kategori',
            'Lokasi',
            'Kondisi',
            'Jumlah',
            'Harga Satuan',
            'Total Nilai',
            'Tanggal Perolehan',
            'Keterangan',
            'Dibuat Oleh',
            'Tanggal Dibuat',
        ];
    }

    public function map($inventory): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $inventory->kode_barang ?? '-',
            $inventory->nama_barang,
            $inventory->kategori->nama_kategori,
            $inventory->lokasi->nama_lokasi,
            $inventory->kondisi->nama_kondisi,
            $inventory->jumlah,
            'Rp ' . number_format($inventory->harga_satuan, 0, ',', '.'),
            'Rp ' . number_format($inventory->total_nilai, 0, ',', '.'),
            $inventory->tanggal_perolehan ? $inventory->tanggal_perolehan->format('d/m/Y') : '-',
            $inventory->keterangan ?? '-',
            $inventory->creator->name ?? '-',
            $inventory->created_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2563EB']
                ],
                'font' => ['color' => ['rgb' => 'FFFFFF'], 'bold' => true],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 15,  // Kode
            'C' => 30,  // Nama
            'D' => 20,  // Kategori
            'E' => 20,  // Lokasi
            'F' => 15,  // Kondisi
            'G' => 10,  // Jumlah
            'H' => 18,  // Harga
            'I' => 18,  // Total
            'J' => 15,  // Tanggal
            'K' => 30,  // Keterangan
            'L' => 15,  // User
            'M' => 18,  // Created
        ];
    }
}
