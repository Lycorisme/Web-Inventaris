<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitBreakdown extends Model
{
    protected $fillable = [
        'no_lambung',
        'tipe_unit',
        'register_number',
        'status_komisioning',
    ];
}
