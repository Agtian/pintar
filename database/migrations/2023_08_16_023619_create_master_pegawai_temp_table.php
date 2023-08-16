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
        Schema::create('m_pegawai_temp', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pegawai_id')->nullable();
            $table->string('gelardepan')->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->string('gelarbelakang_nama')->nullable();
            $table->string('nomorindukpegawai')->nullable();
            $table->string('jeniskelamin')->nullable();
            $table->string('tempatlahir_pegawai')->nullable();
            $table->date('tgl_lahirpegawai')->nullable();
            $table->string('pegawai_aktif')->nullable();
            $table->string('agama')->nullable();
            $table->string('golongandarah')->nullable();
            $table->string('alamatemail')->nullable();
            $table->string('notelp_pegawai')->nullable();
            $table->string('nomobile_pegawai')->nullable();
            $table->string('photopegawai')->nullable();
            $table->string('namaunitkerja')->nullable();
            $table->string('pendidikan_nama')->nullable();
            $table->string('jabatan_nama')->nullable();
            $table->string('pangkat_nama')->nullable();
            $table->string('pendkualifikasi_nama')->nullable();
            $table->string('golonganpegawai_nama')->nullable();
            $table->string('kelompokpegawai_nama')->nullable();
            $table->tinyInteger('status_user')->default('0')->comment('0=tidak_aktif,1=aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_pegawai_temp');
    }
};
