<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleCheckMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user && auth()->user()->isUser()){
            abort(403);
        }elseif (!$user){
            if ($request->segment(1) == 'api') {
                abort(401);
            }
            return redirect()->route('login');
        }
        return $next($request);
    }
}
