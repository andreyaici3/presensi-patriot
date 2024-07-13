<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Unique;

class UniqueWithConnection implements ValidationRule
{

    protected $table;
    protected $column;
    protected $ignore;
    protected $connection;

    public function __construct($table, $column, $ignore = null, $connection = null)
    {
        $this->table = $table;
        $this->column = $column;
        $this->ignore = $ignore;
        $this->connection = $connection;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = DB::connection($this->connection)->table($this->table)->where($this->column, $value);

        if ($this->ignore){
            $query->where('id', '!=', $this->ignore);
        }

        if ($query->exists()){
            $fail("$attribute sudah terdaftar");
        }
    }
}
