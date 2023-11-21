<?php

use App\Models\Guru;
use App\Models\Hari;
use App\Models\Kelas;
use App\Models\MasterJadwal;
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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Guru::class,'kode_guru')->constrained('master_guru', 'kode_guru');
            $table->foreignIdFor(MasterJadwal::class, 'id_jadwal')->constrained('master_jadwal');
            $table->foreignIdFor(Kelas::class,'id_kelas')->constrained('kelas');
            $table->foreignIdFor(Hari::class,'id_hari')->constrained('master_hari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
