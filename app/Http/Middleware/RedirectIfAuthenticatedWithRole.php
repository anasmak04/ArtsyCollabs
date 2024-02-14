<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticatedWithRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , ...$roles): Response
    {

        if (Auth::check()) {
            $userRoleName = Auth::user()->role->name;

            if (in_array($userRoleName, $roles)) {
                switch ($userRoleName) {
                    case 'admin':
                        return redirect('/project');
                    case 'artiste':
                        return redirect('/home');
                }
            }
        }
        return $next($request);
    }
}
