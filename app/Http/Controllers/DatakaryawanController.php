<?php

namespace App\Http\Controllers;

use App\Models\Datakaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatakaryawanController extends Controller
{
    function datakaryawanview_owner()
    {
        $karyawan = Datakaryawan::all();
        $user = Auth::user();
        return view('owner.datakaryawan', compact('user', 'karyawan'));
    }

    function datakaryawanview_kepalakandang()
    {
        $karyawan = Datakaryawan::all();
        $user = Auth::user();
        return view('kepalakandang.datakaryawan', compact('user', 'karyawan'));
    }

    function getidkaryawan($id_karyawan)
    {
        $karyawan = Datakaryawan::findOrFail($id_karyawan);
        return response()->json($karyawan);
    }

    function updatedata(Request $request, $id_karyawan)
    {
        $karyawan = Datakaryawan::findOrFail($id_karyawan);
        $karyawan->nama_karyawan = $request->input('nama');
        $karyawan->tanggal_masuk = $request->input('tanggalMasuk');
        $karyawan->alamat = $request->input('alamat');
        $karyawan->no_hp = $request->input('noHp');
        $karyawan->save();
    }


    function createdata(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama' => 'required',
            'tanggal_masuk' => 'required|date',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        // Simpan data karyawan ke dalam database
        $karyawan = new Datakaryawan();
        $karyawan->nama_karyawan = $request->nama;
        $karyawan->tanggal_masuk = $request->tanggal_masuk;
        $karyawan->alamat = $request->alamat;
        $karyawan->no_hp = $request->no_hp;
        $karyawan->save();

        // Response dengan data karyawan yang baru saja disimpan dalam format JSON
        return response()->json(['data' => $karyawan]);
    }

    function deletedata($id_karyawan)
    {
        // Lakukan operasi delete data berdasarkan ID yang diterima
        // Contoh:
        $karyawan = Datakaryawan::findOrFail($id_karyawan);
        $karyawan->delete();
    }
}
