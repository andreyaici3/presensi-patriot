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
        Schema::table('master_guru', function (Blueprint $table) {
            $table->enum("jabatan", ["guru", "staff"])->after("email")->default("guru");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_guru', function (Blueprint $table) {
            $table->dropColumn("jabatan");
        });
    }
};
