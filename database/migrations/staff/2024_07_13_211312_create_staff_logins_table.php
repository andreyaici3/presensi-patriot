<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected $connection;

    public function __construct()
    {
        $this->connection = env('DB_STAFF_CONNECTION', 'db_staff');
    }

    public function up(): void
    {
        Schema::connection($this->connection)->create('staff_logins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->string('password');
            $table->string('device_token')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('staff_logins');
    }
};
