<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AtkTransaction extends Model
{
    protected $fillable = [
        'atk_item_id',
        'tipe_transaksi',
        'jumlah',
        'keterangan',
        'tanggal_transaksi',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
    ];

    public function atkItem(): BelongsTo
    {
        return $this->belongsTo(AtkItem::class);
    }
}
