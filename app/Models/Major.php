<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = ['code','name', "program_keahlian", "konsentrasi_keahlian"];

    public function classes(){
        return $this->hasMany(Classes::class, 'major_id');
    }

    public function getProgramKeahlianAcronymAttribute()
    {
        return $this->formatProgramKeahlian($this->program_keahlian);
    }

    public function getKonsentrasiKeahlianAcronymAttribute()
    {
        return $this->formatProgramKeahlian($this->konsentrasi_keahlian);
    }

    public function getKonsentrasiKeahlianFullAttribute()
    {
        return $this->konsentrasi_keahlian;
    }

    public function getProgramKeahlianFullAttribute()
    {
        return $this->program_keahlian;
    }

    private function formatProgramKeahlian($value)
    {
        $value = str_replace("dan", "", $value);
        $words = explode(' ', $value);
        $acronym = '';

        foreach ($words as $word) {
            if (strlen($word) > 2) {
                $acronym .= strtoupper($word[0]);
            }
        }

        return $acronym;
    }

}
