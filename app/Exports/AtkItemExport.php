<?php

namespace App\Exports;

use App\Models\AtkItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AtkItemExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return AtkItem::all()->map(function ($item, $index) {
            return [
                'No' => $index + 1,
                'Kode Barang' => $item->kode_barang,
                'Nama Barang' => $item->nama_barang,
                'Kategori' => $item->kategori,
                'Satuan' => $item->satuan,
                'Stok Awal' => $item->stok_awal,
                'Stok Sekarang' => $item->stok_sekarang,
                'Keterangan' => $item->keterangan,
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Kode Barang', 'Nama Barang', 'Kategori', 'Satuan', 'Stok Awal', 'Stok Sekarang', 'Keterangan'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '2563EB']]],
        ];
    }
}
