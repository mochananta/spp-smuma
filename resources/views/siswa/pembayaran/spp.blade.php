@extends('siswa.dashboard')

@section('content')
<div class="header-box mb-4 d-flex justify-content-between align-items-center">
  <div>
    <h4 class="mb-0">Pembayaran SPP</h4>
    <p class="subtext">Berikut adalah detail tagihan pembayaran SPP Anda</p>
  </div>
  <img src="{{ asset('assets/img/logo smuma.png') }}" alt="Logo" class="logo-img">
</div>

{{-- Informasi Siswa --}}
<div class="card p-3 mb-4 shadow-sm border-0" style="border-radius: 0.5rem;">
  <h5 class="mb-3 fw-bold text-white px-3 py-2" style="background-color: #a7dfff; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">Data Siswa</h5>
  <div class="row px-3">
    <div class="col-md-6">
      <p><strong>Nama</strong> : Elga Nanda</p>
      <p><strong>NISN</strong> : 0012345678</p>
      <p><strong>Kelas</strong> : XII</p>
      <p><strong>Rombel</strong> : XII TKJ</p>
    </div>
    <div class="col-md-6">
      <p><strong>Jurusan</strong> : TKJ</p>
      <p><strong>Sekolah</strong> : SMKS Muhammadiyah 5 Srono</p>
      <p><strong>Tahun Ajaran</strong> : 2024/2025</p>
    </div>
  </div>
</div>

{{-- Tabel Tagihan --}}
<div class="card p-3 shadow-sm border-0" style="border-radius: 0.5rem;">
  <h5 class="mb-3 fw-bold text-white px-3 py-2" style="background-color: #a7dfff; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">Tagihan SPP</h5>
  <form id="form-spp" class="px-3">
    <table class="table table-bordered align-middle mb-3">
      <thead class="table-light">
        <tr>
          <th>Bulan</th>
          <th>Nominal</th>
          <th class="text-center">Pilih</th>
        </tr>
      </thead>
      <tbody>
        @php $bulan = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret']; @endphp
        @foreach ($bulan as $index => $nama)
        <tr>
          <td>{{ $nama }}</td>
          <td>Rp. 110.000</td>
          <td class="text-center">
            <input type="checkbox" name="bulan[]" value="{{ $nama }}" class="form-check-input bulan-check" onchange="hitungTotal()">
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr class="table-light fw-bold">
          <td colspan="2" class="text-end">Total Tagihan</td>
          <td class="text-center" id="totalTagihan">Rp. 0</td>
        </tr>
      </tfoot>
    </table>

    <div class="text-end">
      <button type="submit" class="btn btn-primary px-4">Bayar</button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
  function hitungTotal() {
    let total = 0;
    const nominal = 110000;
    document.querySelectorAll('.bulan-check').forEach(cb => {
      if (cb.checked) total += nominal;
    });
    document.getElementById('totalTagihan').textContent = 'Rp. ' + total.toLocaleString('id-ID');
  }
</script>
@endpush