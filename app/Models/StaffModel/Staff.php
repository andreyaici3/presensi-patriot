<?php

namespace App\Models\StaffModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staff';

    protected $connection = '';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = env('DB_STAFF_CONNECTION');
    }

    protected $fillable = [
        'name', 'position', 'email', 'phone', 'birth_date', 'address', 'gender', 'photo', 'hire_date', 'status', 'nip', 'nik'
    ];

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = \Carbon\Carbon::createFromFormat('d F Y', $value)->format('Y-m-d');
    }

    public function getBirthDateAttribute($value)
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

    public function login()
    {
        return $this->hasOne(StaffLogin::class);
    }
}
