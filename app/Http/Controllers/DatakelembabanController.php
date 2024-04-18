<?php

namespace App\Http\Controllers;

use App\Models\Datakelembaban;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatakelembabanController extends Controller
{
    function datakelembabanview()
    {
        // Ambil data dari MySQL
        $dataKelembaban = Datakelembaban::all();

        $user = Auth::user();

        return view('general.datakelembaban', compact('dataKelembaban', 'user'));
    }

    public function sensordata(Request $request)
    {

        $kelembaban = $request->input('kelembaban');

        if ($kelembaban !== null) {
            $sensorData = new Datakelembaban();
            $sensorData->kelembaban = $kelembaban;
            $sensorData->status = 'Belum Diganti'; // Atau nilai status yang sesuai
            $sensorData->save();

            return response()->json(['message' => 'Data tersimpan dengan sukses'], 200);
        } else {
            return response()->json(['message' => 'Gagal menyimpan data: Nilai kelembaban tidak boleh null'], 400);
        }
    }

    public function speedometer()
    {
        $kelembabanterbaru = Datakelembaban::latest()->value('kelembaban'); // Misalnya, mendapatkan kelembaban terbaru dari database
        return response()->json(['kelembabanterbaru' => $kelembabanterbaru]);
    }
}
