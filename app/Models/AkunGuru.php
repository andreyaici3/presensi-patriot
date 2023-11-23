<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Str;

class AkunGuru extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = "akun_guru";

    protected $fillable = ["email", "password", "blokir"];

    public function createToken(string $name, array $abilities = ['*'], $userId = null)
    {
        $userId = $userId ?? $this->getKey();

        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(80)),
            'abilities' => $abilities,
            'tokenable_id' => $userId,
            'tokenable_type' => get_class($this),
        ]);

        return new NewAccessToken($token, $token->id . '|' . $plainTextToken);
    }


}
