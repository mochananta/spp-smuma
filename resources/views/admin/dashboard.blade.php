@extends('admin.dashboardsmuma')

@section('content')
    <div class="container-fluid px-4">
        <div class="row mt-5 text-center justify-content-center">
            {{-- Kartu Penerimaan --}}
            <div class="col-md-3 col-6 mb-4">
                <div class="card shadow-sm text-white" style="background-color:#91D3FF;">
                    <div class="card-body">
                        <img src="https://img.icons8.com/ios/50/cash-in-hand.png" width="30" height="30" class="mb-2" />
                        <h6 class="fw-bold">Penerimaan Bulan Ini</h6>
                        <div class="fs-5">Rp {{ number_format($penerimaanBulanIni ?? 0, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-4">
                <div class="card shadow-sm text-white" style="background-color:#91D3FF;">
                    <div class="card-body">
                        <img src="https://img.icons8.com/ios/50/get-cash--v1.png" width="30" height="30" class="mb-2" />
                        <h6 class="fw-bold">Penerimaan Tahun Ini</h6>
                        <div class="fs-5">Rp {{ number_format($penerimaanTahunIni ?? 0, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tunggakan Terbanyak --}}
        <div class="row justify-content-center">
            @foreach (['X', 'XI', 'XII'] as $kelas)
                <div class="col-md-4 col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light fw-bold text-center">
                            Tunggakan Terbanyak Kelas {{ $kelas }}
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-bordered table-sm m-0 text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Rombel</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($tunggakanPerKelas[$kelas]) && $tunggakanPerKelas[$kelas])
                                        @php $siswa = $tunggakanPerKelas[$kelas]; @endphp
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $siswa->nama_siswa }}</td>
                                            <td>{{ $siswa->nama_rombel ?? '-' }}</td>
                                            <td>Rp {{ number_format($siswa->total_tunggakan, 0, ',', '.') }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="4">Tidak ada data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
