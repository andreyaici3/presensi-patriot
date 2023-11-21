<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class Role
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
        // abort(403, 'Anda tidak memiliki hak mengakses laman tersebut!');
    }
}
