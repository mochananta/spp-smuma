<?php

namespace App\Http\Controllers;

use App\Models\KategoriPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KategoriPembayaranController extends Controller
{
    public function kategori()
    {
        $kategoris = KategoriPembayaran::all(); // Ambil semua data siswa
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'kategori' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);


        try {
            $data = KategoriPembayaran::create([
                'kategori' => $request->kategori,
                'nominal' => $request->nominal,
            ]);

            if ($data) {
                return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
            } else {
                return redirect()->back()->with('error', 'Data gagal disimpan.');
            }
        } catch (\Exception $e) {
            Log::error('Gagal simpan kategori: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan.');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        try {
            $kategori_pembayaran = KategoriPembayaran::findOrFail($id);
            $kategori_pembayaran->update([
                'kategori' => $request->kategori,
                'nominal' => $request->nominal, // pastikan ini ada
            ]);

            return redirect()->route('kategori.index')->with('success', 'Data kategori pembayaran berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui data kategori pembayaran: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui data kategori pembayaran.')->withInput();
        }
    }
    public function destroy($id)
    {
        try {
            $kategori_pembayaran = KategoriPembayaran::findOrFail($id);
            $kategori_pembayaran->delete();

            return redirect()->back()->with('success', 'kategori pembayaran berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus kategori pembayaran: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kategori pembayaran.');
        }
    }
}
