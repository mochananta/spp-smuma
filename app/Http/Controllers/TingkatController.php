<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tingkat;
use Illuminate\support\Facades\Log;

class TingkatController extends Controller
{
    public function index()
    {
        $tingkats = Tingkat::all();
        return view('admin.tingkat.index', compact('tingkats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tingkat' => 'required|string|max:20',
        ]);

        try {
            $data = Tingkat::create([
                'tingkat' => $request->tingkat,
            ]);

            return redirect()->back()->with('success', 'Tingkat berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Gagal simpan tingkat: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tingkat' => 'required|string|max:255',
        ]);

        try {
            $tingkat = Tingkat::findOrFail($id);
            $tingkat->update([
                'tingkat' => $request->tingkat,
            ]);

            return redirect()->route('tingkat.index')->with('success', 'Tingkat berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui tingkat: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui tingkat.')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $tingkat = Tingkat::findOrFail($id);
            $tingkat->delete();

            return redirect()->back()->with('success', 'Tingkat berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus tingkat: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus tingkat.');
        }
    }
}
