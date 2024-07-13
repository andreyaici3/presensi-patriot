<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection;
    protected $db_utama;

    public function __construct()
    {
        $this->connection = env('DB_STAFF_CONNECTION', 'db_staff');
        $this->db_utama = env("DB_DATABASE");
    }

    public function up(): void
    {
        Schema::connection($this->connection)->create('staff_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('academic_year_id');
            $table->date('date');
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
            $table->boolean('present')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')
                  ->references('id')
                  ->on('staff')
                  ->onConnection('db_staff')
                  ->onDelete('cascade');

            $table->foreign('academic_year_id')
                  ->references('id')
                  ->on($this->db_utama . '.academic_years')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('staff_attendances');
    }
};
