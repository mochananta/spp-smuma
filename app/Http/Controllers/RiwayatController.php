<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function spp()
    {
        $siswaId = Auth::user()->siswa->id;

        $tagihanSpp = Tagihan::with('kategori')
            ->where('siswa_id', $siswaId)
            ->whereHas('kategori', function ($q) {
                $q->where('kategori', 'spp');
            })
            ->get();

        $riwayat = Pembayaran::with(['tagihan.kategori'])
            ->where('siswa_id', $siswaId)
            ->whereHas('tagihan.kategori', function ($q) {
                $q->where('kategori', 'spp');
            })
            ->get();

        return view('siswa.riwayat.riwayat-spp', compact('tagihanSpp', 'riwayat'));
    }

    public function ujian()
    {
        $siswaId = Auth::user()->siswa->id;

        $tagihanUjian = Tagihan::with('kategori')
            ->where('siswa_id', $siswaId)
            ->whereHas('kategori', function ($q) {
                $q->where('kategori', 'ujian');
            })
            ->get();

        $riwayat = Pembayaran::with(['tagihan.kategori'])
            ->where('siswa_id', $siswaId)
            ->whereHas('tagihan.kategori', function ($q) {
                $q->where('kategori', 'ujian');
            })
            ->get();

        return view('siswa.riwayat.riwayat-ujian', compact('tagihanUjian', 'riwayat'));
    }

    public function total()
    {
        $siswaId = Auth::user()->siswa->id;

        $riwayat = Pembayaran::with(['tagihan.kategori'])
            ->where('siswa_id', $siswaId)
            ->get();

        // Hitung total nominal dari seluruh pembayaran
        $totalPembayaran = $riwayat->sum('nominal');

        return view('siswa.riwayat.riwayat-total', compact('riwayat', 'totalPembayaran'));
    }
}
