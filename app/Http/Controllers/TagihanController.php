<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with(['rombel', 'tahunAjaran', 'tagihans.kategori'])->get();
        $tahun_ajaran = TahunAjaran::all();
        $rombels = Rombel::all();
        $tagihans = Tagihan::with('kategori')->get();

        return view('admin.kirim_tagihan.index', compact('siswas', 'tagihans', 'tahun_ajaran', 'rombels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'kategori_pembayaran_id' => 'required|exists:kategori_pembayarans,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
        ]);

        $kategori = \App\Models\KategoriPembayaran::find($request->kategori_pembayaran_id);

        foreach ($request->ids as $id) {
            $siswa = Siswa::with('rombel')->find($id);

            Tagihan::create([
                'siswa_id' => $siswa->id,
                'kategori_pembayaran_id' => $kategori->id,
                'tahun_ajaran_id' => $request->tahun_ajaran_id,
                'kelas' => $siswa->rombel->rombel,
                'foto' => $siswa->foto,
                'bulan' => Carbon::now()->translatedFormat('F'),
                'nominal' => $kategori->nominal,
            ]);
        }

        return redirect()->route('kirim_tagihan.index')->with('success', 'Tagihan berhasil dikirim.');
    }
}
