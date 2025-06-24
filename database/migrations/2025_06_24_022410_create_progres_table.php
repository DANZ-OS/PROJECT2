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
        Schema::create('progres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('durasi_belajar'); // dalam menit
            $table->foreignId('kegiatan_id')->nullable()->constrained('kegiatan')->onDelete('set null');
            $table->enum('status_sebelum', ['Belum Dimulai', 'Sedang Berjalan', 'Selesai'])->nullable();
            $table->enum('status_sesudah', ['Belum Dimulai', 'Sedang Berjalan', 'Selesai'])->nullable();
            $table->timestamps();
            // Constraint CHECK (durasi_belajar > 0) bisa ditambahkan manual jika perlu di DB.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres');
    }
};