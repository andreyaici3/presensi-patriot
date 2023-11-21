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
        Schema::create('master_guru', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_guru')->unique();
            $table->bigInteger('nik')->unique();
            $table->string('nama_guru');
            $table->string('email');
            $table->string('password');
            $table->boolean('blokir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_guru');
    }
};
