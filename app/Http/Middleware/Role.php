<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        //verifies that the role matches the role access
        /*this ensures that if a user is accessing a dashboard that is not access on its role, the user will be redirected to the dashboard
        */
        if($request->user()->role !== $role){
            
            return redirect('dashboard');
        }
    
        return $next($request);
    }
}
