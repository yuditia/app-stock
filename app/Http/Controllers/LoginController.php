<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            return response()->json([
                'response' => 200,
                'message' => 'You have Successfully loggedin'
              ]);
        }

        return response()->json([
                'response' => 500,
                'message' => 'Oppes! Email Anda Belum Terdaftar'
            ]);

    }


    public function logout( Request $request )
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'response' => 200,
            'message' => 'You can Logout now'
          ]);
    }
}
