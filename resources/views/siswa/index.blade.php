@extends('siswa.dashboard')

@section('content')
<div class="header-box d-flex justify-content-between align-items-center">
  <div>
    <h4 class="mb-0">Selamat Datang</h4>
    <p class="subtext">Di Sistem Pembayaran SPP Online<br>SMKS Muhammadiyah 5 Srono</p>
  </div>
  <img src="{{ asset('assets/img/logo smuma.png') }}" alt="Logo" class="logo-img">
</div>

<div class="row mt-5 g-4">
  <div class="col-md-4">
    <a href="{{ route('siswa.pembayaran.spp') }}" class="text-decoration-none text-dark">
      <div class="card-menu hover-effect">
        <img src="{{ asset('assets/icon/iconspp.png') }}" class="icon-img" alt="SPP">
        <h5>Pembayaran SPP</h5>
      </div>
    </a>
  </div>
  <div class="col-md-4">
    <a href="{{ route('siswa.pembayaran.ujian') }}" class="text-decoration-none text-dark">
      <div class="card-menu hover-effect">
        <img src="{{ asset('assets/icon/iconujian.png') }}" class="icon-img" alt="Ujian">
        <h5>Pembayaran Ujian</h5>
      </div>
    </a>
  </div>
</div>
@endsection