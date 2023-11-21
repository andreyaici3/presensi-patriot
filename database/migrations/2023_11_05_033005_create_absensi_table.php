<?php

use App\Models\Guru;
use App\Models\Kelas;
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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Guru::class, 'kode_guru')->constrained('master_guru', 'kode_guru');
            $table->foreignIdFor(Kelas::class, 'id_kelas')->constrained('kelas');
            $table->string('keterangan');
            $table->boolean('status_hadir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
