<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Siswa([
            'nama' => $row['nama'],
            'nis' => $row['nis'],
            'email' => $row['email'],
            'nama_orang_tua' => $row['nama_orang_tua'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tinggal_lahir'],
            'telepon_orang_tua' => $row['telepon_orang_tua'],
            'alamat' => $row['alamat'],
            'rombels_id' => $row['rombels_id'],
            'jurusans_id' => $row['jurusans_id'],
            'tahun_ajarans_id' => $row['tahun_ajarans_id'],
            'agama' => $row['agama'],
        ]);
    }
}
