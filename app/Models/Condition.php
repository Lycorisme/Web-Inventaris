<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Condition extends Model
{
    protected $fillable = [
        'nama_kondisi',
        'warna_label',
        'deskripsi',
    ];

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class, 'kondisi_id');
    }
}
