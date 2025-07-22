<div class="sidebar p-3">
  <div class="profile-box mb-4 text-center">
    <img src="{{ asset('assets/img/profil.png') }}" alt="Foto Profil" class="img-fluid rounded-circle mb-2" width="100">
    <div class="fw-bold">{{ Auth::user()->name }}</div>
    <small class="text-muted">(Siswa/Siswi)</small>
    <div class="logout-btn mt-2">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn logout-custom">Logout</button>
      </form>
    </div>
  </div>

  <ul class="nav flex-column">
    <li class="nav-item">
      <a href="{{ route('siswa.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('siswa.index') ? 'active' : '' }}">
        <i class="fas fa-home me-2"></i> Beranda
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link d-flex align-items-center" data-bs-toggle="collapse" href="#pembayaranSubmenu" role="button" aria-expanded="false" aria-controls="pembayaranSubmenu">
        <i class="fas fa-wallet me-2"></i> Pembayaran
        <i class="fas fa-chevron-down ms-auto"></i>
      </a>
      <ul class="collapse list-unstyled ps-4" id="pembayaranSubmenu">
        <li>
          <a href="{{ route('siswa.pembayaran.spp') }}" class="nav-link d-flex align-items-center">
            <i class="fas fa-money-bill-wave me-2"></i> SPP
          </a>
        </li>
        <li>
          <a href="{{ route('siswa.pembayaran.ujian') }}" class="nav-link d-flex align-items-center">
            <i class="fas fa-file-invoice-dollar me-2"></i> Ujian
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link d-flex align-items-center" data-bs-toggle="collapse" href="#riwayatSubmenu" role="button" aria-expanded="false" aria-controls="riwayatSubmenu">
        <i class="fas fa-clock-rotate-left me-2"></i> Riwayat Pembayaran
        <i class="fas fa-chevron-down ms-auto"></i>
      </a>
      <ul class="collapse list-unstyled ps-4" id="riwayatSubmenu">
        <li>
          <a href="{{ route('siswa.riwayat.riwayat-spp') }}" class="nav-link d-flex align-items-center">
            <i class="fas fa-money-bill-wave me-2"></i> Riwayat SPP
          </a>
        </li>
        <li>
          <a href="{{ route('siswa.riwayat.riwayat-ujian') }}" class="nav-link d-flex align-items-center">
            <i class="fas fa-file-invoice-dollar me-2"></i> Riwayat Ujian
          </a>
        </li>
        <li>
          <a href="{{ route('siswa.riwayat.riwayat-total') }}" class="nav-link d-flex align-items-center">
            <i class="fas fa-receipt me-2"></i> Total Pembayaran
          </a>
        </li>
      </ul>
    </li>
  </ul>
</div>