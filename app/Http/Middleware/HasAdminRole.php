<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user && $user->roles()->where('name','admin')->exists()) {
            return $next($request);   
        }
        
        return response()->json([
            'status' => 401,
            'message' => 'Unauthorize'
        ], 401);
    }
}
