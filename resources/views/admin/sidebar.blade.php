<style>
    .sb-sidenav .nav-link,
    .sb-sidenav .sb-sidenav-menu .nav-link {
        color: white !important;
    }

    .sb-sidenav .nav-link:hover {
        color: #f8f9fa !important;
    }
</style>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion text-white" style="background-color:rgb(94, 174, 255);" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion" id="sidenavAccordion">
                        <div class="sb-sidenav-menu fw-bold text-white">
                            <div class="nav">
                                <a class="nav-link" href="/dashboard">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Dashboard
                                </a>

                                <!-- Transaksi -->
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTransaksi" aria-expanded="false"
                                    aria-controls="collapseTransaksi">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Transaksi
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseTransaksi" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="/pembayaran">Pembayaran</a>
                                        <a class="nav-link" href="/kirim_tagihan">Kirim Tagihan</a>
                                        {{-- <a class="nav-link" href="/kirim_tunggakan">Kirim Tunggakan</a> --}}
                                    </nav>
                                </div>

                                <!-- Data Master -->
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#collapseMaster" aria-expanded="false"
                                    aria-controls="collapseMaster">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                    Data Master
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseMaster" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="/tahun_ajaran">Tahun Ajaran</a>
                                        <a class="nav-link" href="/jurusan">Jurusan</a>
                                        <a class="nav-link" href="/tingkat">Tingkat</a>
                                        <a class="nav-link" href="/rombel">Rombel</a>
                                        <a class="nav-link" href="/kategori">Kategori Pembayaran</a>
                                        <a class="nav-link" href="{{ route('siswas.index') }}">Data Siswa</a>
                                    </nav>
                                </div>

                                <!-- Laporan & User -->
                                <a class="nav-link" href="charts.html">
                                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                    Laporan
                                </a>
                                <a class="nav-link" href="/user">
                                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                    User
                                </a>

                                <!-- Pengaturan -->
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#collapsePengaturan" aria-expanded="false"
                                    aria-controls="collapsePengaturan">
                                    <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                    Pengaturan
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapsePengaturan" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">

                                        <!-- Template Pesan with nested submenu -->
                                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTemplatePesan" aria-expanded="false"
                                            aria-controls="collapseTemplatePesan">
                                            Template Pesan
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i>
                                            </div>
                                        </a>
                                        <div class="collapse" id="collapseTemplatePesan"
                                            data-bs-parent="#collapsePengaturan">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="#">Tunggakan SPP</a>
                                                <a class="nav-link" href="#">Tunggakan Ujian</a>
                                                <a class="nav-link" href="#">Tagihan SPP</a>
                                                <a class="nav-link" href="#">Tagihan Ujian</a>
                                            </nav>
                                        </div>


                                    </nav>
                                </div>
                            </div>
                        </div>

                    </nav>
                </div>
            </div>
        </div>
    </nav>
</div>
