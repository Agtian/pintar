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
        Schema::create('trans_ujian_diklats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('acara_diklat_id');
            $table->unsignedBigInteger('kategori_soal_diklat_id');
            $table->string('nama_kelas');
            $table->date('tgl_ujian');
            $table->time('jam_ujian');
            $table->text('keterangan');
            $table->integer('durasi_waktu');
            $table->tinyInteger('status')->default('1')->comment('1=aktif,2=tidak_aktif,3=batal');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('acara_diklat_id')->references('id')->on('m_acara_diklat')->onDelete('cascade');
            $table->foreign('kategori_soal_diklat_id')->references('id')->on('t_kategori_soal_diklat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trans_ujian_diklats');
    }
};
