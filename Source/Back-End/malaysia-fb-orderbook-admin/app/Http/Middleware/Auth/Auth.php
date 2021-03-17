<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->to('/login');
        }

        if(auth()->user()->type != 'ADMIN') {
            Session::flash('creds_error', 'You are not an admin!');
            auth()->logout();
            return redirect()->to('/login');
        }

        return $next($request);
    }
}
