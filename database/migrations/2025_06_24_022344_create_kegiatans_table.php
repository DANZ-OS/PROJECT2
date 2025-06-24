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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->nullable()->constrained('mata_kuliah')->onDelete('cascade');
            $table->string('nama', 100)->nullable(false);
            $table->text('deskripsi')->nullable();
            $table->enum('jenis', ['tugas', 'proyek', 'kuis', 'presentasi', 'nyatet materi', 'UTS', 'UAS']);
            $table->date('deadline');
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi']);
            $table->integer('estimasi_jam');
            $table->enum('status', ['Belum Dimulai', 'Sedang Berjalan', 'Selesai'])->default('Belum Dimulai');
            $table->timestamps();
            // Constraint CHECK (estimasi_jam > 0) bisa ditambahkan manual jika perlu di DB.
            // $table->fullText(['nama', 'deskripsi']); // Contoh untuk pencarian teks penuh
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};