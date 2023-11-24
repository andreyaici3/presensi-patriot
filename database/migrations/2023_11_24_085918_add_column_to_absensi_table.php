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
        Schema::table('absensi', function (Blueprint $table) {
            $table->string('nama_guru')->after('keterangan')->nullable();
            $table->string('hari')->after('nama_guru')->nullable();
            $table->string('tanggal')->after('hari')->nullable();
            $table->string('waktu_absen')->after('tanggal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->dropColumn('nama_guru');
            $table->dropColumn('hari');
            $table->dropColumn('tanggal');
            $table->dropColumn('waktu_absen');
        });
    }
};
