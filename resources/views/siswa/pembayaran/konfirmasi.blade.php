@extends('siswa.dashboard')

@section('content')
<div class="mb-4">
  <h4 class="fw-bold">INFORMASI TRANSAKSI</h4>
</div>

{{-- Informasi Siswa --}}
<div class="mb-3">
  <p><strong>Nama</strong> : Elga Nanda</p>
  <p><strong>NISN</strong> : 0012345678</p>
  <p><strong>Rombel</strong> : XII TKJ</p>
  <p><strong>Jurusan</strong> : Teknik Komputer dan Jaringan</p>
</div>

{{-- Daftar Tagihan --}}
<div class="table-responsive mb-3">
  <table class="table table-bordered">
    <thead style="background-color: #cce6ff;">
      <tr>
        <th>No</th>
        <th>Nama Tagihan</th>
        <th>Bulan</th>
        <th>Nominal</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Pembayaran SPP</td>
        <td>Juli</td>
        <td>Rp. 110.000</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Pembayaran SPP</td>
        <td>Agustus</td>
        <td>Rp. 110.000</td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3" class="text-end fw-bold">Total :</td>
        <td class="fw-bold">Rp. 220.000</td>
      </tr>
    </tfoot>
  </table>
  <div class="text-danger fst-italic fw-semibold">
    * periksa kembali list tagihan dengan seksama sebelum melakukan pembayaran!!
  </div>
</div>

{{-- Informasi Rekening --}}
<div class="mb-3">
  <h6 class="fw-bold text-center py-2" style="background-color: #cce6ff;">Informasi Rekening</h6>
  <table class="table table-bordered text-center mb-0">
    <thead class="table-light">
      <tr>
        <th>Bank</th>
        <th>Rekening</th>
        <th>Atas Nama</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>BRI</td>
        <td>370201020064530</td>
        <td>Ribut Susanto</td>
      </tr>
    </tbody>
  </table>
</div>

{{-- Form Upload Bukti --}}
<form action="{{ route('siswa.pembayaran.kirim') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <h6 class="fw-bold text-center py-2" style="background-color: #cce6ff;">Bukti Pembayaran</h6>

  <div class="row mb-3">
    <div class="col-md-6">
      <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
      <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label for="bukti_bayar" class="form-label">File <small class="text-muted">(JPG/PNG)</small></label>
      <input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control" accept="image/png, image/jpeg" required>
    </div>
  </div>

  <div class="text-end">
    <button type="submit" class="btn btn-primary px-4">Simpan</button>
  </div>
</form>
@endsection
