<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
     // Check if the user is authenticated and is an admin
    //  dd($request->user()->type,User::TYPE['1']);
     if ($request->user() && $request->user()->type == 1) {
        return $next($request);
    }

    // If not admin, redirect or return unauthorized response
    return response()->json(['message' => 'Unauthorized User'], 403);
}
    }

