<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleCheckMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->isUser()){
            abort(403);
        }
        return $next($request);
    }
}
