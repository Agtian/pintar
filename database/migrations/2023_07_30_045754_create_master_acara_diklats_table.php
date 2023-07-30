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
        Schema::create('m_acara_diklat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kategori_soal_diklat_id');
            $table->string('nama_diklat');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->bigInteger('biaya_per_orang');
            $table->string('brosur');
            $table->text('catatan');
            $table->tinyInteger('status')->default('0')->comment('0=hidden,1=aktif,2=tidak_aktif');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kategori_soal_diklat_id')->references('id')->on('t_kategori_soal_diklat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_acara_diklat');
    }
};
