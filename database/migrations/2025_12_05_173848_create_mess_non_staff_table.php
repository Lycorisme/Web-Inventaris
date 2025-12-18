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
        Schema::create('mess_non_staff', function (Blueprint $table) {
            $table->id();
            $table->string('mess');
            $table->string('no_kamar');
            $table->string('sn')->unique();
            $table->string('nama_penghuni');
            $table->string('dept');
            $table->string('poh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mess_non_staff');
    }
};
