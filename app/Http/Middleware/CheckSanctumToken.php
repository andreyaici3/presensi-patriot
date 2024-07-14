<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\BaseController;
use App\Models\PersonalAccessTokenStaff;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

class CheckSanctumToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route() ? $request->route()->getName() : null;
        $token = $request->bearerToken();
        $new = new BaseController();
        if (!$token)
            return $new->sendError("Request Tidak Lengkap", Response::HTTP_UNAUTHORIZED);

        if ($routeName === "api.auth.staff"){
            Sanctum::usePersonalAccessTokenModel(PersonalAccessTokenStaff::class);
            $staff = Auth::guard('sanctum')->user();
            if (!$staff)
                return $new->sendError("Token Kadaluarsa / Salah", Response::HTTP_UNAUTHORIZED);
        } else {
            $user = Auth::guard('sanctum')->user();
            if (!$user)
                return $new->sendError("Token Kadaluarsa / Salah", Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
