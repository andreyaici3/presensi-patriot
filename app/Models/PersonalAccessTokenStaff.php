<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessTokenStaff;

class PersonalAccessTokenStaff extends SanctumPersonalAccessTokenStaff
{
    protected $connection = '';
    protected $table = "personal_access_tokens";

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = env("DB_STAFF_CONNECTION");
    }
}
