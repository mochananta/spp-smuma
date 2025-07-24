<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $penerimaanBulanIni = Pembayaran::whereMonth('tanggal_bayar', $bulanIni)
            ->whereYear('tanggal_bayar', $tahunIni)
            ->sum('nominal');

        $penerimaanTahunIni = Pembayaran::whereYear('tanggal_bayar', $tahunIni)
            ->sum('nominal');

        $kelas = ['X', 'XI', 'XII'];
        $tunggakanPerKelas = [];

        foreach ($kelas as $k) {
            $siswaTunggakan = Tagihan::select(
                DB::raw('SUM(tagihans.nominal) as total_tunggakan'),
                'siswas.nama as nama_siswa',
                'rombels.rombel as nama_rombel'
            )
                ->join('siswas', 'tagihans.siswa_id', '=', 'siswas.id')
                ->join('rombels', 'siswas.rombel_id', '=', 'rombels.id')
                ->join('tingkats', 'rombels.tingkat_id', '=', 'tingkats.id')
                ->where('tingkats.tingkat', $k)
                ->where('tagihans.status', 'belum_lunas')
                ->groupBy('tagihans.siswa_id', 'siswas.nama', 'rombels.rombel')
                ->orderByDesc('total_tunggakan')
                ->first();

            $tunggakanPerKelas[$k] = $siswaTunggakan;
        }

        return view('admin.dashboard', compact(
            'penerimaanBulanIni',
            'penerimaanTahunIni',
            'tunggakanPerKelas'
        ));
    }
}
