<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 50)->unique()->nullable()->comment('Auto generate atau manual');
            $table->string('nama_barang', 255);
            
            // Foreign Keys
            $table->foreignId('kategori_id')
                  ->constrained('categories')
                  ->onDelete('restrict');
            
            $table->foreignId('lokasi_id')
                  ->constrained('locations')
                  ->onDelete('restrict');
            
            $table->foreignId('kondisi_id')
                  ->constrained('conditions')
                  ->onDelete('restrict');
            
            // Data Barang
            $table->integer('jumlah')->default(0);
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->decimal('total_nilai', 15, 2)->default(0)->comment('Calculated: jumlah × harga_satuan');
            $table->date('tanggal_perolehan')->nullable();
            $table->text('keterangan')->nullable();
            
            // User Tracking
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            
            // Soft Delete
            $table->softDeletes();
            $table->timestamps();
            
            // Indexes untuk performance
            $table->index('kode_barang');
            $table->index('nama_barang');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
