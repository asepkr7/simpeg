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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->char('gender');
            $table->string('agama');
            $table->char('gol_darah');
            $table->string('status_pernikahan');
            $table->string('nik');
            $table->string('telp');
            $table->string('email');
            $table->string('alamat');
            $table->string('npwp');
            $table->string('bpjs');
            $table->string('karpeg');
            $table->string('status_kepegawaian');
            $table->string('no_sk_cpns');
            $table->date('tmt_sk_cpns');
            $table->string('no_sk_pns');
            $table->date('tmt_sk_pns');
            $table->integer('tpp');
            $table->string('image')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
