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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi dengan User
            $table->string('name'); // Nama Karyawan
            $table->string('division'); // Divisi
            $table->date('tanggal'); // Tanggal Pengajuan Lembur
            $table->time('jam_mulai'); // Jam Mulai
            $table->time('jam_selesai'); // Jam Selesai
            $table->decimal('jml_lembur', 5, 2); // Jumlah Jam Lembur
            $table->text('keterangan'); // Keterangan
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps(); // created_at dan updated_at
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
