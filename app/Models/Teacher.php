<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        "kode_guru",
        "nip",
        "nik",
        "first_name",
        "last_name",
        "gender",
        "date_of_birth",
        "address",
        "phone_number",
        "email",
        "hire_date",
        "status",
    ];

    public static function addGuru($request){
        return self::create($request->all());
    }

    public static function updateGuru($request, $id){
        return self::find($id)->update($request->all());
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = \Carbon\Carbon::createFromFormat('d F Y', $value)->format('Y-m-d');
    }

    public function getDateOfBirthAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d F Y');
    }

    public function setHireDateAttribute($value)
    {
        $this->attributes['hire_date'] = \Carbon\Carbon::createFromFormat('d F Y', $value)->format('Y-m-d');
    }

    public function getHireDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d F Y');
    }

    public function attendances(){
        return $this->hasMany(Attendance::class, 'teacher_id', 'id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedulles::class);
    }

    public function login()
    {
        return $this->hasOne(TeacherLogin::class);
    }
}
