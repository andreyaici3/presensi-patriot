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
        Schema::create('master_siswa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nis')->unique();
            $table->string('nama_siswa', 100);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string("email")->unique();
            $table->bigInteger("no_hp");
            $table->timestamps();
        });

        Schema::create('akun_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->boolean('blokir')->default(0);
            $table->boolean('locked')->default(0);
            $table->timestamps();
        });

        Schema::table('akun_siswa', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('master_siswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_siswa');
        Schema::dropIfExists('master_siswa');
    }
};
