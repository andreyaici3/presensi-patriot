<?php

use App\Models\Guru;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Guru::class, 'kode_staff')->constrained('master_guru', 'kode_guru');
            $table->string("tanggal_absen");
            $table->string("hari");
            $table->boolean("absen_masuk");
            $table->time("jam_masuk");
            $table->boolean("absen_keluar")->nullable();
            $table->time("jam_keluar")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi_staff');
    }
};
