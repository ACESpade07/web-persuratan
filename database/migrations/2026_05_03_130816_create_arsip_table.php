<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsip', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('jenis'); // 'Masuk' atau 'Keluar'
            $table->string('kontak'); // pengirim atau tujuan
            $table->string('perihal');
            $table->date('tanggal_surat');
            $table->string('file')->nullable();
            $table->unsignedBigInteger('surat_id'); // id asli dari tabel asal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip');
    }
};