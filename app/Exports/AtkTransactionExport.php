<?php

namespace App\Exports;

use App\Models\AtkTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AtkTransactionExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return AtkTransaction::with('atkItem')->get()->map(function ($transaction, $index) {
            return [
                'No' => $index + 1,
                'Nama Barang' => $transaction->atkItem->nama_barang,
                'Tipe Transaksi' => ucfirst($transaction->tipe_transaksi),
                'Jumlah' => $transaction->jumlah,
                'Tanggal' => $transaction->tanggal_transaksi->format('d-m-Y'),
                'Keterangan' => $transaction->keterangan,
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Nama Barang', 'Tipe Transaksi', 'Jumlah', 'Tanggal', 'Keterangan'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '6366F1']]],
        ];
    }
}
