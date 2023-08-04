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
        Schema::create('m_daftar_mou_diklat', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat', 100);
            $table->string('no_mou', 100);
            $table->date('tgl_mou');
            $table->string('bidang_kerjasama');
            $table->string('nama_instansi');
            $table->string('kota_instansi');
            $table->string('nama_ttd_mou');
            $table->string('nip_tdd_mou');
            $table->string('jabatan_tdd_mou');
            $table->integer('jangka_waktu_tahun');
            $table->date('tgl_mulai_mou');
            $table->date('tgl_akhir_mou');
            $table->tinyInteger('status_mou')->default('1')->comment('1=aktif,2=tidak_aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_daftar_mou_diklat');
    }
};
