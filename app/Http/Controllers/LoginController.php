<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function validation(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        // Ambil kredensial dari permintaan
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        // Coba untuk melakukan autentikasi pengguna
        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'owner') {
                return redirect('owner/datakelembaban');
            } elseif (Auth::user()->role == 'kepalakandang') {
                return redirect('kepalakandang/datakelembaban');
            }
        } else {
            // Jika tidak, kembalikan dengan pesan kesalahan
            return redirect()->back()->withErrors('Email atau password salah')->withInput();
        }
    }

    function lupapasswordview() {
        return view('login.lupapassword');
    }

    function logout() {
        Auth::logout();
        return redirect('');
    }
}
