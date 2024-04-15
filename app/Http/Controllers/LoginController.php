<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $req)
    {
        $credentials = $this->validate($req, [
            'username' => "required",
            'password' => "required"
        ]);

        if (Auth::attempt($credentials, $req->get('remember'))) {
            $req->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'username' => "Incorrect Credentials"
        ])->onlyInput('username');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

}
