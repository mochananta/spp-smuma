@extends('siswa.dashboard')

@section('content')
<div class="container mt-4">
  <h5><strong>Riwayat Pembayaran</strong></h5>

  <table class="table table-bordered">
    <thead class="table-primary">
      <tr>
        <th>Tanggal Bayar</th>
        <th>Jumlah</th>
        <th>Nama Pembayaran</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>28 Agustus 2024</td>
        <td>Rp. 110.000</td>
        <td>SPP Bulan Juli</td>
        <td>Lunas</td>
      </tr>
      <tr>
        <td>28 Agustus 2024</td>
        <td>Rp. 110.000</td>
        <td>SPP Bulan Agustus</td>
        <td>Lunas</td>
      </tr>
      <tr>
        <td>28 Agustus 2024</td>
        <td>Rp. 125.000</td>
        <td>Penilaian Tengah Semster 1</td>
        <td>Lunas</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
