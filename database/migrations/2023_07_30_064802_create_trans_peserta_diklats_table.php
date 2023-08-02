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
        Schema::create('t_peserta_diklat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftaran_diklat_id');
            $table->unsignedBigInteger('surat_diklat_id');
            $table->unsignedBigInteger('jenis_praktikan_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->text('alamat');
            $table->string('email')->unique();
            $table->string('no_hp', 18);
            $table->string('nama_sekolah');
            $table->string('jurusan')->nullable();
            $table->string('jabatan')->nullable();
            $table->timestamps();

            $table->foreign('pendaftaran_diklat_id')->references('id')->on('t_pendaftaran_diklat')->onDelete('cascade');
            $table->foreign('surat_diklat_id')->references('id')->on('t_surat_diklat')->onDelete('cascade');
            $table->foreign('jenis_praktikan_id')->references('id')->on('m_jenis_praktikan')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_peserta_diklat');
    }
};
