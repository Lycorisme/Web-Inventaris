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
        Schema::create('kendaraan_aktifs', function (Blueprint $table) {
            $table->id();
            $table->string('no_lambung')->unique();
            $table->string('tipe_unit');
            $table->string('register_number')->unique();
            $table->enum('status_komisioning', ['aktif', 'tidak_aktif', 'maintenance'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan_aktifs');
    }
};
