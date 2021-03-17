<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check()) {
                return redirect('/dashboard');
            }

            return $next($request);
        });
    }

    public function index()
    {
        return view('pages.login');
    }

    public function attempt(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (auth()->attempt($credentials)) {
            return redirect()->to('/dashboard');
        }

        session()->flash('creds_error', 'Your email or password was incorrect!');
        return redirect()->back();
    }
}
