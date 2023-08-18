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
        Schema::create('t_pendapatan_diklat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftaran_diklat_id');
            $table->unsignedBigInteger('surat_diklat_id')->nullable();
            $table->unsignedBigInteger('tarif_diklat_id')->nullable();
            $table->unsignedBigInteger('honorarium_diklat_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('user_validated_id')->nullable();
            $table->bigInteger('jasa_sarana');
            $table->bigInteger('jasa_lainnya');
            $table->bigInteger('tarif_honorarium')->default('0');
            $table->integer('jumlah_peserta_tambahan')->default('0');
            $table->integer('jumlah_peserta');
            $table->integer('total_waktu')->default('0');
            $table->bigInteger('tarif_pre_klinik')->default('0');
            $table->bigInteger('total_tarif');
            $table->tinyInteger('f_status')->default('0')->comment('0=belum_lunas,1=lunas,2=batal,3=pending_peserta');
            $table->dateTime('tgl_bayar')->nullable();
            $table->timestamps();

            $table->foreign('pendaftaran_diklat_id')->references('id')->on('t_pendaftaran_diklat')->onDelete('cascade');
            $table->foreign('surat_diklat_id')->references('id')->on('t_surat_diklat')->onDelete('cascade');
            $table->foreign('tarif_diklat_id')->references('id')->on('m_tarif_diklat')->onDelete('cascade');
            $table->foreign('honorarium_diklat_id')->references('id')->on('m_honorarium_diklat')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pendapatan_diklat');
    }
};
