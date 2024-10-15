<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    public function index(){
       return view('login');
    }

    public function loginProses(Request $request){
        $request->validate([
            'email'=> 'required',
            'password'=> 'required',
        ]);
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($data)){
            return redirect(Auth::user()->role);
        }
        return back()
        ->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])
        ->withInput();
    }

    public function logout(Request $request)
    {
        // Logout pengguna yang sedang login
        Auth::logout();

        // Regenerate CSRF token untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login atau halaman lain yang diinginkan
        return redirect('/login')->with('message', 'Successfully logged out!');
    }

    public function RegristerAccount(){

    }
}
