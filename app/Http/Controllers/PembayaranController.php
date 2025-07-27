<?php

namespace App\Http\Controllers;

use App\Models\KategoriPembayaran;
use App\Models\Pembayaran;
use App\Models\TahunAjaran;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\TransaksiMidtrans;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    public function ujian()
    {
        $user = auth()->user();

        $siswa = Siswa::with(['rombel', 'jurusan', 'tahunAjaran'])->where('user_id', $user->id)->firstOrFail();

        $dibayarTagihanIds = TransaksiMidtrans::where('user_id', $user->id)
            ->where('status', 'settlement')
            ->pluck('tagihan_ids')
            ->flatMap(function ($ids) {
                return json_decode($ids, true);
            })->unique()->toArray();

        $tagihans = Tagihan::where('siswa_id', $siswa->id)
            ->where('kategori_pembayaran_id', 2) 
            ->whereNotIn('id', $dibayarTagihanIds)
            ->get();

        return view('siswa.pembayaran.ujian', compact('siswa', 'tagihans'));
    }


    public function spp()
    {
        $user = auth()->user();

        $siswa = Siswa::with(['rombel', 'jurusan', 'tahunAjaran'])->where('user_id', $user->id)->firstOrFail();

        $dibayarTagihanIds = TransaksiMidtrans::where('user_id', $user->id)
            ->where('status', 'settlement')
            ->pluck('tagihan_ids')
            ->flatMap(function ($ids) {
                return json_decode($ids, true);
            })->unique()->toArray();

        $tagihans = Tagihan::where('siswa_id', $siswa->id)
            ->where('kategori_pembayaran_id', 1)
            ->whereNotIn('id', $dibayarTagihanIds)
            ->get();

        return view('siswa.pembayaran.spp', compact('siswa', 'tagihans'));
    }

    public function konfirmasi()
    {
        return view('siswa.pembayaran.konfirmasi');
    }

    public function pembayaran(Request $request)
    {
        $tahun = $request->tahun_ajaran_id;
        $rombel = $request->rombel;

        $tahun_ajaran = TahunAjaran::all();
        $rombels = Rombel::all();
        $kategoriPembayarans = KategoriPembayaran::all();

        $pembayarans = Siswa::with(['pembayarans', 'rombel', 'tahunAjaran'])
            ->when($tahun, fn($q) => $q->where('tahun_ajaran_id', $tahun))
            ->when($rombel, fn($q) => $q->where('rombel_id', $rombel))
            ->get();

        return view('admin.pembayaran.index', compact(
            'pembayarans',
            'tahun_ajaran',
            'rombels',
            'kategoriPembayarans',
            'tahun',
            'rombel'
        ));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'siswa_id' => 'required|exists:siswas,id',
                'kategori_pembayaran_id' => 'required|exists:kategori_pembayarans,id',
                'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
                'bulan' => 'required',
                'tanggal_bayar' => 'required|date',
                'nominal' => 'required|numeric',
                'keterangan' => 'nullable|string',
            ]);

            Pembayaran::create([
                'siswa_id' => $request->siswa_id,
                'kategori_pembayaran_id' => $request->kategori_pembayaran_id,
                'tahun_ajaran_id' => $request->tahun_ajaran_id,
                'bulan' => $request->bulan,
                'tanggal_bayar' => $request->tanggal_bayar,
                'nominal' => $request->nominal,
                'kode' => Str::uuid(),
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->back()->with('success', 'Pembayaran berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan pembayaran: ' . $e->getMessage());
        }
    }

    public function tagihan()
    {
        $tagihans = Tagihan::all();
        return view('admin.tagihan.index', compact('tagihans'));
    }

    public function riwayat($id)
    {
        $siswa = Siswa::findOrFail($id);
        $pembayarans = Pembayaran::with('kategoriPembayaran') 
            ->where('siswa_id', $id)
            ->orderBy('tanggal_bayar', 'desc')
            ->get();

        return view('admin.pembayaran._riwayat', compact('siswa', 'pembayarans'));
    }
}
