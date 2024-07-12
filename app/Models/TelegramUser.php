<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'telegram_id'];

    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
