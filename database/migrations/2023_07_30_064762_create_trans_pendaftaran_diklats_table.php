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
        Schema::create('t_pendaftaran_diklat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('surat_diklat_id')->nullable();
            $table->unsignedBigInteger('acara_diklat_id')->nullable();
            $table->bigInteger('daftar_mou_diklat_id')->nullable();
            $table->string('kode_pendaftaran', 100);
            $table->integer('jumlah_peserta');
            $table->integer('jumlah_peserta_tambahan')->default(0);
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
            $table->dateTime('tgl_pendaftaran');
            $table->tinyInteger('status_pendaftaran')->default('1')->comment('0=pending_peserta,1=aktif_belum_lunas,2=aktif_lunas,3=selesai_lunas,4=batal');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('surat_diklat_id')->references('id')->on('t_surat_diklat')->onDelete('cascade');
            $table->foreign('acara_diklat_id')->references('id')->on('m_acara_diklat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pendaftaran_diklat');
    }
};
