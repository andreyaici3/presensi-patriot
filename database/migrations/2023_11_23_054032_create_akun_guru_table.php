<?php

use App\Models\Guru;
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
            $table->dropColumn('password');
            $table->dropColumn('blokir');
            $table->index('email');
        });

        Schema::create('akun_guru', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            // $table->foreign('email')->references('email')->on('master_guru');
            $table->string('password');
            $table->boolean('blokir')->default(0);
            $table->boolean('locked')->default(0);
            $table->timestamps();
        });

        Schema::table('akun_guru', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('master_guru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun_guru');

        Schema::table('master_guru', function (Blueprint $table) {
            $table->string('password')->after('email');
            $table->string('blokir')->after('password');
            $table->dropIndex(['email']);
        });
    }
};
