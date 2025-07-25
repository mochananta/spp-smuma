<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use Illuminate\Support\Facades\Log;
use App\Models\Jurusan;
use App\Models\KategoriPembayaran;
use App\Models\Pembayaran;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\User;
use App\Models\TahunAjaran;
use App\Models\Tingkat;
use App\Models\Tunggakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with(['rombel', 'jurusan', 'tahunAjaran', 'pembayarans'])->get();
        $rombels = Rombel::all();
        $tahunAjarans = TahunAjaran::all();
        $jurusans = Jurusan::all();

        return view('admin.siswa.index', compact('siswas', 'rombels', 'tahunAjarans', 'jurusans'));
    }

    public function rombel()
    {
        $rombels = Rombel::all();
        return view('admin.rombel.index', compact('rombels'));
    }

    public function kategori()
    {
        $kategori_pembayarans = KategoriPembayaran::all();
        return view('admin.kategori.index', compact('kategori_pembayarans'));
    }

    public function user()
    {
        $siswas = Siswa::with(['rombel', 'jurusan', 'tahunAjaran'])->get();
        $rombels = Rombel::all();
        $jurusans = Jurusan::all();
        $tahunAjarans = TahunAjaran::all();

        return view('user.index', compact('siswas', 'rombels', 'jurusans', 'tahunAjarans'));
    }

    public function jurusan()
    {
        $jurusans = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusans'));
    }

    public function tingkat()
    {
        $tingkats = Tingkat::all();
        return view('admin.tingkat.index', compact('tingkats'));
    }

    public function tagihan()
    {
        $siswas = Siswa::all();
        $tagihans = Tagihan::all();
        return view('admin.kirim_tagihan.index', compact('siswas', 'tagihans'));
    }

    public function pindah(Request $request)
    {
        $request->validate([
            'rombel_id' => 'required|exists:rombels,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'ids' => 'required|array|min:1',
        ]);

        foreach ($request->ids as $id) {
            Siswa::where('id', $id)->update([
                'rombel_id' => $request->rombel_id,
                'tahun_ajaran_id' => $request->tahun_ajaran_id,
            ]);
        }

        return redirect()->back()->with('success', 'Siswa berhasil dipindahkan.');
    }

    public function create()
    {
        $rombels = Rombel::all();
        return view('admin.siswa.create', compact('rombels'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nis' => 'required|string|max:20|unique:siswas,nis',
            'email' => 'required|email|unique:siswas,email',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'agama' => 'required|string',
            'nama_ortu' => 'required|string|max:100',
            'jenis_kelamin' => 'required|string',
            'rombel_id' => 'required|exists:rombels,id',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'telepon_ortu' => 'required|string|max:20',
            'telepon' => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);
        try {
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('foto', $filename, 'public');
                $validated['foto'] = $filename;
            }

            $user = User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'nis' => $validated['nis'],
                'role' => 'siswa',
                'password' => bcrypt($request->password),
            ]);

            $validated['user_id'] = $user->id;

            $siswa = Siswa::create($validated);

            return redirect()->back()->with('success', 'Siswa dan user berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Gagal simpan siswa: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan.');
        }
    }

    public function updateRombelBatch(Request $request)
    {
        $request->validate([
            'selected_ids'   => 'required',
            'rombels_id'     => 'required|exists:rombels,id',
            'tahun'          => 'required',
            'tindakan_final' => 'required|in:pindah,naik'
        ]);

        $ids = explode(',', $request->selected_ids);
        $rombels_id = $request->rombels_id;

        foreach ($ids as $id) {
            $siswa = Siswa::find($id);
            if ($siswa) {
                $siswa->rombel_id = $rombels_id;
                $siswa->save();
            }
        }

        $pesan = $request->tindakan_final === 'pindah' ? 'dipindahkan' : 'dinaikkan';

        return redirect()->back()->with('success', "Siswa berhasil $pesan ke rombel baru.");
    }

    public function detailA4($id)
    {
        $siswa = Siswa::with('rombel')->findOrFail($id);
        return view('admin.siswa.detail_a4', compact('siswa'));
    }
    public function importForm()
    {
        return view('admin.siswa.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048',
        ]);

        try {
            Excel::import(new SiswaImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data siswa berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }
}
