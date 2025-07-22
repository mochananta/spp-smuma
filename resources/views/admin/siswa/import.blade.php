@extends('admin.dashboardsmuma')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Impor Data Siswa</h2>

        {{-- Flash message sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Flash message error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Validasi errors --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih File Excel (.xls, .xlsx, .csv)</label>
                        <input type="file" name="file" accept=".csv, .xls, .xlsx" required class="form-control"
                            id="file">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-upload me-1"></i> Impor
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
