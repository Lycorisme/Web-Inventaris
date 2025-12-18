<?php

namespace App\Exports;

use App\Models\TotalKendaraan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TotalKendaraanExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return TotalKendaraan::all()->map(function ($item, $index) {
            return [
                'No' => $index + 1,
                'No Lambung' => $item->no_lambung,
                'Tipe Unit' => $item->tipe_unit,
                'Register Number' => $item->register_number,
                'Status' => ucfirst(str_replace('_', ' ', $item->status_komisioning)),
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'No Lambung', 'Tipe Unit', 'Register Number', 'Status'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '2563EB']]],
        ];
    }
}
