<?php

namespace App\Models\StaffModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class StaffLogin extends Model
{
    use HasFactory;

    protected $connection = '';
    protected $fillable = ['staff_id', 'password', 'device_token'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = env('DB_STAFF_CONNECTION');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
