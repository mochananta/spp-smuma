<?php

namespace App\Http\Controllers;

use App\Models\KategoriPembayaran;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanspp(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $kategoriSpp = KategoriPembayaran::where('kategori', 'spp')->first();

        $total = 0;
        if ($kategoriSpp) {
            $total = Pembayaran::where('kategori_pembayaran_id', $kategoriSpp->id)
                ->whereMonth('tanggal_bayar', $bulan)
                ->whereYear('tanggal_bayar', $tahun)
                ->sum('nominal');
        }

        $tanggal = \Carbon\Carbon::createFromDate($tahun, $bulan)->translatedFormat('F Y');

        return view('admin.laporan.spp', compact('bulan', 'tahun', 'tanggal', 'total'));
    }

    public function laporanUjian(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $kategoriUjian = KategoriPembayaran::where('kategori', 'ujian')->first();

        $total = 0;
        if ($kategoriUjian) {
            $total = Pembayaran::where('kategori_pembayaran_id', $kategoriUjian->id)
                ->whereMonth('tanggal_bayar', $bulan)
                ->whereYear('tanggal_bayar', $tahun)
                ->sum('nominal');
        }

        $tanggal = \Carbon\Carbon::createFromDate($tahun, $bulan)->translatedFormat('F Y');

        return view('admin.laporan.ujian', compact('bulan', 'tahun', 'tanggal', 'total'));
    }
}
