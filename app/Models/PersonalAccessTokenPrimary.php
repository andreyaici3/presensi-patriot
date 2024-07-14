<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessTokenPrimary extends SanctumPersonalAccessToken
{
    protected $connection = '';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = env("DB_CONNECTION");
    }
}
