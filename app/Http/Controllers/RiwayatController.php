<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\TransaksiMidtrans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function spp()
    {
        $siswaId = Auth::user()->siswa->id;
        $userId = Auth::id();

        $tagihanSpp = Tagihan::with('kategori')
            ->where('siswa_id', $siswaId)
            ->whereHas('kategori', function ($q) {
                $q->where('kategori', 'spp');
            })
            ->get();

        $riwayatAll = TransaksiMidtrans::where('user_id', $userId)
            ->where('status', 'settlement')
            ->orderBy('created_at', 'desc')
            ->get();

        $riwayat = $riwayatAll->filter(function ($trx) {
            $tagihanIds = json_decode($trx->tagihan_ids, true);
            if (is_array($tagihanIds)) {
                $kategoriIds = Tagihan::whereIn('id', $tagihanIds)
                    ->pluck('kategori_pembayaran_id')
                    ->unique()
                    ->toArray();
                return in_array(1, $kategoriIds);
            }
            return false;
        });

        return view('siswa.riwayat.riwayat-spp', compact('tagihanSpp', 'riwayat'));
    }


    public function ujian()
    {
        $siswaId = Auth::user()->siswa->id;
        $userId = Auth::id();

        $tagihanUjian = Tagihan::with('kategori')
            ->where('siswa_id', $siswaId)
            ->whereHas('kategori', function ($q) {
                $q->where('kategori', 'ujian');
            })
            ->get();

        $riwayatAll = TransaksiMidtrans::where('user_id', $userId)
            ->where('status', 'settlement')
            ->orderBy('created_at', 'desc')
            ->get();

        $riwayat = $riwayatAll->filter(function ($trx) {
            $tagihanIds = json_decode($trx->tagihan_ids, true);
            if (is_array($tagihanIds)) {
                $kategoriIds = Tagihan::whereIn('id', $tagihanIds)
                    ->pluck('kategori_pembayaran_id')
                    ->unique()
                    ->toArray();
                return in_array(2, $kategoriIds); // 2 = Ujian
            }
            return false;
        });

        return view('siswa.riwayat.riwayat-ujian', compact('tagihanUjian', 'riwayat'));
    }

    public function total()
    {
        $siswaId = Auth::user()->siswa->id;

        $riwayat = Pembayaran::with(['kategoriPembayaran'])
            ->where('siswa_id', $siswaId)
            ->get();

        $totalPembayaran = $riwayat->sum('nominal');

        return view('siswa.riwayat.riwayat-total', compact('riwayat', 'totalPembayaran'));
    }
}
