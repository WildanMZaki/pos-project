<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    # index untuk menampilkan halaman login
    public function index()
    {
        return view('auth.login');
    }

    # process: Untuk memproses request login
    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->remember == 'on';

        /**
         * Kalau di framework lain: harus lakukan:
         * 1. Cek user berdasarkan email, ada atau enggak
         * 2. bcrypt ulang password yang diinput
         * 3. Pembandingan hasil bcrypt yang diinputkan dengan yang ada di database
         */

        $success = Auth::attempt($credentials, $remember);
        if ($success) {
            return redirect()->intended('/dash');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(['gagal_login' => 'Email atau kata sandi salah']);
        }
    }
}
