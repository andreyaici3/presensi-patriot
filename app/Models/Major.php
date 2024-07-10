<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = ['code','name'];

    public function classes(){
        return $this->hasMany(Classes::class, 'major_id');
    }

}
