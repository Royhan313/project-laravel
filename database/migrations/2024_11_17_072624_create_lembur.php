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
        Schema::create('listlembur', function (Blueprint $table) {
            $table->id(); // ID utama
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi dengan User
            $table->string('name'); // Nama Karyawan
            $table->string('division'); // Divisi
            $table->date('tanggal'); // Tanggal Pengajuan Lembur
            $table->time('jam_masuk'); // Jam Masuk
            $table->time('jam_pulang'); // Jam Pulang
            $table->time('jam_mulai'); // Jam Mulai Lembur
            $table->time('jam_selesai'); // Jam Selesai Lembur
            $table->decimal('jml_lembur', 5, 2); // Jumlah Jam Lembur
            $table->text('pekerjaan'); // Pekerjaan yang dilakukan
            $table->text('hasil_lembur'); // Hasil Lembur yang dikerjakan
            $table->string('upload_doc')->nullable(); // Path file yang diupload
            $table->string('lokasi'); // Lokasi lembur
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status pengajuan lembur
            $table->timestamps(); // Timestamps created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listlembur');
    }
};
