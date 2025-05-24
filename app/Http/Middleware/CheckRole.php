<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check())
        {
            return redirect('login');
        }

        $user = Auth::user();

        foreach ($roles as $role)
        {
            if ($user->roles === $role)
            {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized Action');
    }
}
