<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Models\Rombel;
use App\Models\TahunAjaran;
use App\Models\Tingkat;
use Illuminate\Support\Facades\Log;

class RombelController extends Controller
{
    public function index()
    {
        $rombels = Rombel::with(['jurusan', 'tahunAjaran', 'tingkat'])->withCount('siswas')->get();
        $jurusans = Jurusan::all();
        $tahun_ajarans = TahunAjaran::all();
        $tingkats = Tingkat::all();

        return view('admin.rombel.index', compact('rombels', 'jurusans', 'tahun_ajarans', 'tingkats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rombel' => 'required|string|max:50',
            'tingkat_id' => 'required|exists:tingkats,id',
            'jurusan_id' => 'required|exists:jurusans,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
        ]);

        try {
            Rombel::create($request->only('rombel', 'tingkat_id', 'jurusan_id', 'tahun_ajaran_id'));
            return redirect()->route('rombel.index')->with('success', 'Rombel berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal simpan rombel: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan.')->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rombel' => 'required|string|max:50',
            'tingkat_id' => 'required|exists:tingkats,id',
            'jurusan_id' => 'required|exists:jurusans,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
        ]);

        try {
            $rombel = Rombel::findOrFail($id);
            $rombel->update($request->only('rombel', 'tingkat_id', 'jurusan_id', 'tahun_ajaran_id'));

            return redirect()->route('rombel.index')->with('success', 'Rombel berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui rombel: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui data rombel.')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $rombel = Rombel::findOrFail($id);
            $rombel->delete();

            return redirect()->route('rombel.index')->with('success', 'Rombel berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus rombel: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus rombel.');
        }
    }
}
