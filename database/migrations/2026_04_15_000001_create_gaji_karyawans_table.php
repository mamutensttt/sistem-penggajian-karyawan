<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gaji_karyawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained()->cascadeOnDelete();
            $table->integer('gaji_pokok');
            $table->integer('lembur');
            $table->integer('pinjaman');
            $table->integer('total_penghasilan');
            $table->integer('total_potongan');
            $table->integer('gaji_bersih');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gaji_karyawans');
    }
};
