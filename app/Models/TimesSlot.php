<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesSlot extends Model
{
    use HasFactory;

    protected $fillable = ['day_id', 'start_time', 'end_time', 'jam_ke'];

    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }

    public function schedule()
    {
        return $this->hasMany(Schedulles::class, 'day_time_slot_id');
    }
}
