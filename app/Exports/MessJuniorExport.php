<?php

namespace App\Exports;

use App\Models\MessJunior;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MessJuniorExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return MessJunior::all()->map(function ($item, $index) {
            return [
                'No' => $index + 1,
                'Mess' => $item->mess,
                'No Kamar' => $item->no_kamar,
                'SN' => $item->sn,
                'Nama Penghuni' => $item->nama_penghuni,
                'Dept' => $item->dept,
                'POH' => $item->poh,
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Mess', 'No Kamar', 'SN', 'Nama Penghuni', 'Dept', 'POH'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '0891B2']]],
        ];
    }
}
