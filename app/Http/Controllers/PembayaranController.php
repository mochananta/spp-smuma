<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\TahunAjaran;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function ujian()
    {
        return view('siswa.pembayaran.ujian');
    }

    public function spp()
    {
        return view('siswa.pembayaran.spp');
    }

    public function konfirmasi()
    {
        return view('siswa.pembayaran.konfirmasi');
    }

    // public function index()
    // {
    //     $pembayarans = Siswa::with(['pembayarans.tahunAjaran', 'rombel', 'tahunAjaran'])->get();
    //     $tahunAjarans = TahunAjaran::all();
    //     $rombels = Rombel::all();

    //     return view('admin.pembayaran.index', compact('pembayarans', 'tahunAjarans', 'rombels'));
    // }

    public function pembayaran(Request $request)
    {
        $tahun = $request->tahun;
        $rombel = $request->rombel;

        $tahun_ajaran = TahunAjaran::all();
        $rombels = Rombel::all();

        $pembayarans = Siswa::with(['pembayarans', 'rombel', 'tahunAjaran'])
            ->when($tahun, function ($query, $tahun) {
                $query->where('tahun_ajaran_id', $tahun);
            })
            ->when($rombel, function ($query, $rombel) {
                $query->where('rombel_id', $rombel);
            })
            ->get();

        return view('admin.pembayaran.index', compact('pembayarans', 'tahun_ajaran', 'rombels', 'tahun', 'rombel'));
    }

    public function tagihan()
    {
        $tagihans = Tagihan::all();
        return view('admin.tagihan.index', compact('tagihans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tagihan_id' => 'nullable|exists:tagihans,id',
            'jumlah' => 'required|numeric|min:0',
            'tanggal_pembayaran' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Pembayaran::create([
            'siswa_id' => $request->siswa_id,
            'tagihan_id' => $request->tagihan_id,
            'jumlah' => $request->jumlah,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil disimpan.');
    }
}
