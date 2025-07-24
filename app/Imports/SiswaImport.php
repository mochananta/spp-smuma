<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $row = array_map('trim', $row);

        // Buat user baru (jika belum ada)
        $user = User::firstOrCreate(
            ['email' => $row['email']],
            [
                'name' => $row['nama'],
                'password' => Hash::make($row['nis']),
                'role' => 'siswa',
                'nis' => $row['nis'],
            ]
        );


        // Simpan siswa dan hubungkan ke user
        return new Siswa([
            'user_id' => $user->id,
            'nama' => $row['nama'],
            'nis' => $row['nis'],
            'email' => $row['email'],
            'agama' => $row['agama'],
            'telepon' => $row['telepon'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => is_numeric($row['tanggal_lahir'])
                ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir'])
                : \Carbon\Carbon::parse($row['tanggal_lahir']),
            'nama_ortu' => $row['nama_ortu'],
            'telepon_ortu' => $row['telepon_ortu'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'alamat' => $row['alamat'],
            'rombel_id' => $row['rombel_id'],
            'jurusan_id' => $row['jurusan_id'],
            'tahun_ajaran_id' => $row['tahun_ajaran_id'],
        ]);
    }
}
