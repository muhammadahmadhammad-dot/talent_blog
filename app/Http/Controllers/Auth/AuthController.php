<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('dashboard.auth.login');
    }
    public function loginCheck(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return to_route('dashboard');
        } else {
            return to_route('login')->withInput()->with('error', 'Sorry I cant\' found you!');
        }
    }
    public function logout()
    {
        Auth::logout();
        return to_route('login')->with('success', 'Logout Successfully!');;
    }
}
