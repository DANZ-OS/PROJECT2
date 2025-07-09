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
        Schema::table('kegiatan', function (Blueprint $table) {
            // Drop foreign key lama jika ada
            $table->dropForeign(['user_id']);
            
            // Tambahkan foreign key baru dengan cascade delete
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            // Drop foreign key dengan cascade
            $table->dropForeign(['user_id']);
            
            // Kembalikan foreign key tanpa cascade
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }
};