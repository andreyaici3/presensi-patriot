<?php

use App\Models\Hari;
use App\Models\Jam;
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
        Schema::create('master_jadwal', function (Blueprint $table) {
            $table->id();
            $table->integer('jam_ke');
            $table->foreignIdFor(Jam::class, 'id_jam')->constrained('master_jam');
            $table->foreignIdFor(Hari::class, 'id_hari')->constrained('master_hari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_jadwal');
    }
};
