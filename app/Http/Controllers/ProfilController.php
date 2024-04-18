<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    function profilview()
    {
        // Ambil informasi pengguna yang telah login
        $user = Auth::user();

        // Meneruskan variabel $user ke dalam view
        return view('general.profil', compact('user'));
    }

    function gantiprofilview()
    {
        // Ambil informasi pengguna yang telah login
        $user = Auth::user();

        // Meneruskan variabel $user ke dalam view
        return view('general.gantiprofil', compact('user'));
    }

    function validation(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users,name,',
            'email' => 'required|email|unique:users,email,',
            'nomerhp' => 'required|numeric|unique:users,nomer_hp,',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ], [
            'username.unique' => 'Username sudah digunakan',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'nomerhp.numeric' => 'Nomer HP harus berupa angka',
            'nomerhp.unique' => 'Nomer HP sudah digunakan',
        ]);

        // Dapatkan pengguna yang sedang diotentikasi
        $user = Auth::user(); // Assuming you want to retrieve the authenticated user

        // Perbarui data pengguna
        $user->name = $request->username;
        $user->email = $request->email;
        $user->nomer_hp = $request->nomerhp;
        // Perbarui kolom lainnya jika ada

        // Simpan perubahan
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui.');
    }
}
