<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'nama_lokasi',
        'pic',
        'deskripsi',
    ];

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class, 'lokasi_id');
    }
}
