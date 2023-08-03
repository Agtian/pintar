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
        Schema::create('m_tarif_pelatihan_pre_klinik', function (Blueprint $table) {
            $table->id();
            $table->string('no_perdir');
            $table->bigInteger('jasa_sarana');
            $table->bigInteger('jasa_pelayanan');
            $table->bigInteger('jumlat_tarif');
            $table->tinyInteger('status_tarif')->default('1')->comment('1=aktif,2=tidak_aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_tarif_pelatihan_pre_klinik');
    }
};
