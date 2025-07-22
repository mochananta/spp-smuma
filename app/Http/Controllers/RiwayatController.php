<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function spp()
    {
        return view('siswa.riwayat.riwayat-spp');
    }

    public function ujian()
    {
        return view('siswa.riwayat.riwayat-ujian');
    }

    public function total()
    {
        return view('siswa.riwayat.riwayat-total');
    }
}
