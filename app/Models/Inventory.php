<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_id',
        'lokasi_id',
        'kondisi_id',
        'jumlah',
        'harga_satuan',
        'total_nilai',
        'tanggal_perolehan',
        'keterangan',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'tanggal_perolehan' => 'date',
        'harga_satuan' => 'decimal:2',
        'total_nilai' => 'decimal:2',
    ];

    // Relationships
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'lokasi_id');
    }

    public function kondisi(): BelongsTo
    {
        return $this->belongsTo(Condition::class, 'kondisi_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    // Auto calculate total_nilai
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($inventory) {
            $inventory->total_nilai = $inventory->jumlah * $inventory->harga_satuan;
        });
    }
}
