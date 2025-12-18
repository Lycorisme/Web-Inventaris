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
        // Drop unique constraints from total_kendaraans
        Schema::table('total_kendaraans', function (Blueprint $table) {
            $table->dropUnique(['no_lambung']);
            $table->dropUnique(['register_number']);
        });

        // Drop unique constraints from kendaraan_aktifs
        Schema::table('kendaraan_aktifs', function (Blueprint $table) {
            $table->dropUnique(['no_lambung']);
            $table->dropUnique(['register_number']);
        });

        // Drop unique constraints from unit_breakdowns
        Schema::table('unit_breakdowns', function (Blueprint $table) {
            $table->dropUnique(['no_lambung']);
            $table->dropUnique(['register_number']);
        });

        // Drop unique constraints from mess_seniors
        Schema::table('mess_seniors', function (Blueprint $table) {
            $table->dropUnique(['sn']);
        });

        // Drop unique constraints from mess_juniors
        Schema::table('mess_juniors', function (Blueprint $table) {
            $table->dropUnique(['sn']);
        });

        // Drop unique constraints from mess_non_staff
        Schema::table('mess_non_staff', function (Blueprint $table) {
            $table->dropUnique(['sn']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-add unique constraints to total_kendaraans
        Schema::table('total_kendaraans', function (Blueprint $table) {
            $table->unique(['no_lambung']);
            $table->unique(['register_number']);
        });

        // Re-add unique constraints to kendaraan_aktifs
        Schema::table('kendaraan_aktifs', function (Blueprint $table) {
            $table->unique(['no_lambung']);
            $table->unique(['register_number']);
        });

        // Re-add unique constraints to unit_breakdowns
        Schema::table('unit_breakdowns', function (Blueprint $table) {
            $table->unique(['no_lambung']);
            $table->unique(['register_number']);
        });

        // Re-add unique constraints to mess_seniors
        Schema::table('mess_seniors', function (Blueprint $table) {
            $table->unique(['sn']);
        });

        // Re-add unique constraints to mess_juniors
        Schema::table('mess_juniors', function (Blueprint $table) {
            $table->unique(['sn']);
        });

        // Re-add unique constraints to mess_non_staff
        Schema::table('mess_non_staff', function (Blueprint $table) {
            $table->unique(['sn']);
        });
    }
};
