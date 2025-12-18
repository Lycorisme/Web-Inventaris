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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('inventory_id')
                  ->nullable()
                  ->constrained('inventories')
                  ->onDelete('cascade');
            
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            
            $table->string('action', 50)->comment('create, update, delete, export, import');
            $table->text('description')->nullable();
            
            // JSON Data
            $table->json('old_data')->nullable()->comment('Data sebelum perubahan');
            $table->json('new_data')->nullable()->comment('Data setelah perubahan');
            
            // Tracking
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            
            $table->timestamp('created_at')->useCurrent();
            
            // Indexes
            $table->index('action');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
