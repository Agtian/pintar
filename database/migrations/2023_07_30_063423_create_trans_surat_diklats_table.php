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
        Schema::create('t_surat_diklat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('no_surat_diklat', 100)->nullable();
            $table->date('tgl_surat_diklat');
            $table->string('perihal');
            $table->string('surat_dari');
            $table->string('nama_instansi');
            $table->string('kota_instansi');
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_surat_diklat');
    }
};
