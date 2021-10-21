<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // If Gate admin passes -> 
        if (Gate::allows('is-admin')) {

            // return next item in request cycle
            return $next($request);
        }

        // else, redirect to home
        return redirect('/');
    }
}


// Add middleware to kernel.php