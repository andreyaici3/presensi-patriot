<?php

namespace App\Models\StaffModel;

use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAttendance extends Model
{
    use HasFactory;

    protected $connection = '';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = env('DB_STAFF_CONNECTION');
    }

    protected $fillable = ['staff_id', 'academic_year_id', 'date', 'clock_in', 'clock_out', 'present', 'notes'];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }


}
