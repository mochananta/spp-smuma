<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanspp()
    {
        $tanggal = Carbon::now()->translatedFormat('d F Y');
        $total = Pembayaran::whereHas('tagihan.kategori', function ($q) {
            $q->where('kategori', 'spp');
        })->sum('nominal');

        return view('admin.laporan.spp', compact('tanggal', 'total'));
    }

    public function laporanujian()
    {
        $tanggal = Carbon::now()->translatedFormat('d F Y');
        $total = Pembayaran::whereHas('tagihan.kategori', function ($q) {
            $q->where('kategori', 'ujian');
        })->sum('nominal');

        return view('admin.laporan.ujian', compact('tanggal', 'total'));
    }
}
