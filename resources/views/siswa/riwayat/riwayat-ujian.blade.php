@extends('siswa.dashboard')

@section('content')
<div class="container mt-4">
  <h5><strong>Pembayaran Ujian</strong></h5>
  <p>Tagihan Sudah Lunas</p>

  <h6 class="mt-4"><strong>Daftar Tagihan</strong></h6>
  <table class="table table-bordered">
    <thead class="table-primary">
      <tr>
        <th>Nama Ujian</th>
        <th>Nominal</th>
        <th>Dibayar</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Penilaian Tengah Semester 1</td>
        <td>Rp. 125.000</td>
        <td>Rp. 125.000</td>
        <td>Lunas</td>
      </tr>
    </tbody>
  </table>

  <h6 class="mt-4"><strong>Riwayat Pembayaran</strong></h6>
  <table class="table table-bordered">
    <thead class="table-primary">
      <tr>
        <th>Tanggal Bayar</th>
        <th>Jumlah</th>
        <th>Nama Ujian</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>28 Agustus 2024</td>
        <td>Rp. 125.000</td>
        <td>Penilaian Tengah Semester 1</td>
        <td>Lunas</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
