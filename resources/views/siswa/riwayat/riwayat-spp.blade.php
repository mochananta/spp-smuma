@extends('siswa.dashboard')

@section('content')
<div class="container mt-4">
  <h5><strong>Pembayaran SPP</strong></h5>
  <p>Tagihan Sudah Lunas</p>

  <h6 class="mt-4"><strong>Daftar Tagihan</strong></h6>
  <table class="table table-bordered">
    <thead class="table-primary">
      <tr>
        <th>Bulan</th>
        <th>Nominal</th>
        <th>Dibayar</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Juli</td>
        <td>Rp. 110.000</td>
        <td>Rp. 110.000</td>
        <td>Lunas</td>
      </tr>
      <tr>
        <td>Agustus</td>
        <td>Rp. 110.000</td>
        <td>Rp. 110.000</td>
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
        <th>Bulan</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>28 Agustus 2024</td>
        <td>Rp. 110.000</td>
        <td>Juli</td>
        <td>Lunas</td>
      </tr>
      <tr>
        <td>28 Agustus 2024</td>
        <td>Rp. 110.000</td>
        <td>Agustus</td>
        <td>Lunas</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
