<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessJunior extends Model
{
    protected $fillable = [
        'mess',
        'no_kamar',
        'sn',
        'nama_penghuni',
        'dept',
        'poh',
    ];
}
