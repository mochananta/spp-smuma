<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Log;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahun_ajarans = TahunAjaran::all();
        return view('admin.tahun_ajaran.index', compact('tahun_ajarans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:20',
            'semester' => 'required|in:Ganjil,Genap',
        ]);

        try {
            TahunAjaran::create($request->only('tahun_ajaran', 'semester'));
            return redirect()->route('tahun_ajaran.index')->with('success', 'Tahun ajaran berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal simpan tahun ajaran: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan.')->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:20',
            'semester' => 'required|in:Ganjil,Genap',
        ]);

        try {
            $tahun_ajaran = TahunAjaran::findOrFail($id);
            $tahun_ajaran->update($request->only('tahun_ajaran', 'semester'));

            return redirect()->route('tahun_ajaran.index')->with('success', 'Tahun ajaran berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui tahun ajaran: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui tahun ajaran.')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $tahun_ajaran = TahunAjaran::findOrFail($id);
            $tahun_ajaran->delete();

            return redirect()->route('tahun_ajaran.index')->with('success', 'Tahun ajaran berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus tahun ajaran: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus tahun ajaran.');
        }
    }
}
