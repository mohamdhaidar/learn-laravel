<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserMiddleWare
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user->role === 'admin')
            return $next($request);

        return response()->json(['message' => 'not allowed for user .'], 403);
    }
}
