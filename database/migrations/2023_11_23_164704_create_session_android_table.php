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
        Schema::create('session_android', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('mac_address');
            $table->string('user_agent')->nullable();
            $table->string('device_name')->nullable();
            $table->timestamps();
        });

        Schema::table('session_android', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('master_guru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_android');
    }
};
