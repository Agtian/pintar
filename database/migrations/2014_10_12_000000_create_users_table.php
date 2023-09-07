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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->bigInteger('daftar_mou_diklat_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('role_as')->default('0')->comment('0=petugas_diklat,1=admin,2=kasir,3=peserta_mou,4=peserta_diklat');
            $table->unsignedBigInteger('role_id');
            $table->tinyInteger('status_user')->default('0')->comment('0=tidak_aktif,1=aktif');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('pegawai_id')->references('id')->on('m_pegawai_temp')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('m_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
