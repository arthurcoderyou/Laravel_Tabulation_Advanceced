<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $url = '';

        //now we will check and identify what role of the user is currently logging in as. 
        //we have to get from the database, from the 'users' table, the 'role' value

        //checks if the user is admin and redirects it to the admin/dashboard route
        if($request->user()->role === 'admin'){
            $url = '/admin/dashboard';
        }elseif($request->user()->role === 'contestant'){
            $url = '/contestant/dashboard';
        }elseif($request->user()->role === 'judge'){
            $url = '/judge/dashboard';
        }elseif($request->user()->role === 'user'){
            $url = '/dashboard';
        }

        //now we will pass the url
        return redirect()->intended($url);



        //return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
