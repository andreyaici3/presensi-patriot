<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\BaseController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSanctumToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $new = new BaseController();
        if (!$token)
            return $new->sendError("Request Tidak Lengkap", Response::HTTP_UNAUTHORIZED);

        $user = Auth::guard('sanctum')->user();
        if (!$user)
            return $new->sendError("Token Kadaluarsa / Salah", Response::HTTP_UNAUTHORIZED);

        return $next($request);
    }
}
