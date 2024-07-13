<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'db_staff';
    public function up(): void
    {
        Schema::connection($this->connection)->create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->bigInteger('nip')->unique();
            $table->bigInteger('nik')->unique()->nullable()->default(null);
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->string('photo')->nullable();
            $table->date('hire_date')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('staff');
    }
};
