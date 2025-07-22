@extends('admin.dashboardsmuma')

@section('content')
    <div class="container-fluid px-4">
        <div class="row mt-5 justify-content-center">
            {{-- Data Penerimaan Bulan Ini --}}
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-white h-100 shadow-lg" style="background-color:rgba(145, 211, 255, 1);">
                    <div class="card-body d-flex flex-column align-items-center text-center">
                        <img class="mx-auto mb-3" width="30" height="30"
                            src="https://img.icons8.com/ios/50/cash-in-hand.png" alt="cash-in-hand" />
                        <h5 class="card-title">Data Penerimaan Bulan Ini</h5>
                        <p class="card-text fs-4">{{ number_format($penerimaanBulanIni ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            {{-- Data Penerimaan Tahun Ini --}}
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-white h-100 shadow-lg" style="background-color:rgba(145, 211, 255, 1);">
                    <div class="card-body d-flex flex-column align-items-center text-center">
                        <img class="mx-auto mb-3" width="30" height="30"
                            src="https://img.icons8.com/ios/50/get-cash--v1.png" alt="get-cash--v1" />
                        <h5 class="card-title">Data Total Penerimaan Tahun Ini</h5>
                        <p class="card-text fs-4">{{ number_format($penerimaanTahunIni ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Placeholder Tunggakan --}}
        <div class="row justify-content-center">
            @foreach (['X', 'XI', 'XII'] as $kelas)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header text-center fw-bold">
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
                                    <tr>
                                        <td>1</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
