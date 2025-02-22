<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountTypeAndInterests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->type === '')
        {
            // Redirect to an error page if not authorized
            return redirect('/typeaccount')->with('error', 'You do not have type');
        }
        else if(Auth::user()->interests === null)
        {
            return redirect('/interests')->with('error', 'You do not have interests');

        }

        return $next($request);
    }
}
