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
        Schema::create('m_tarif_diklat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_kegiatan_id');
            $table->unsignedBigInteger('satuan_kegiatan_id');
            $table->unsignedBigInteger('jenis_praktikan_id');
            $table->unsignedBigInteger('user_id');
            $table->string('no_pergub_tarif')->nullable();
            $table->bigInteger('jasa_sarana');
            $table->bigInteger('jasa_lainnya');
            $table->bigInteger('jumlah');
            $table->tinyInteger('status_tarif')->default('1')->comment('1=aktif,2=tidak_aktif');
            $table->timestamps();
            
            $table->foreign('jenis_kegiatan_id')->references('id')->on('m_jenis_kegiatan')->onDelete('cascade');
            $table->foreign('satuan_kegiatan_id')->references('id')->on('m_satuan_kegiatan')->onDelete('cascade');
            $table->foreign('jenis_praktikan_id')->references('id')->on('m_jenis_praktikan')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_tarif_diklat');
    }
};
