<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Log;

class JurusanController extends Controller
{
    public function jurusan()
    {
        $jurusans = Jurusan::all(); // Ambil semua data siswa
        return view('admin.jurusan.index', compact('jurusans'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'jurusan' => 'required|string|max:255',
        ]);


        try {
            $data = Jurusan::create([
                'jurusan' => $request->jurusan,
            ]);

            if ($data) {
                return redirect()->back()->with('success', 'Jurusan berhasil ditambahkan');
            } else {
                return redirect()->back()->with('error', 'Data gagal disimpan.');
            }
        } catch (\Exception $e) {
            Log::error('Gagal simpan jurusan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jurusan' => 'required|string|max:255',
        ]);

        try {
            $jurusan = Jurusan::findOrFail($id);
            $jurusan->update([
                'jurusan' => $request->jurusan,
            ]);

            return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui data jurusan: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui data jurusan.')->withInput();
        }
    }
    public function destroy($id)
    {
        try {
            $jurusan = Jurusan::findOrFail($id);
            $jurusan->delete();

            return redirect()->back()->with('success', 'Jurusan berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus jurusan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus jurusan.');
        }
    }
}
