<?php

namespace App\Models\StudentModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $connection = "db_students";

    protected $fillable = [
        'name',
        'email',
        'birthdate'
    ];
}
