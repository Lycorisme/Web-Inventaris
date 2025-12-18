<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AtkItem extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'satuan',
        'stok_awal',
        'stok_sekarang',
        'keterangan',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(AtkTransaction::class);
    }
}
