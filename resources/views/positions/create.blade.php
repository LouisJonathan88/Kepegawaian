@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('layouts.sidebar')

        <main class="col-md-10 ms-sm-auto px-md-4">
            <div class="container">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Tambah Jabatan Baru</h1>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('positions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" 
                               value="{{ old('nama_jabatan') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="department_id" class="form-label">Departemen</label>
                        <select class="form-control" id="department_id" name="department_id">
                            <option value="">Pilih Departemen</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">
                                    {{ $department->nama_departemen }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="gaji" class="form-label">Gaji</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="gaji" name="gaji_pokok" 
                                   value="{{ old('gaji_pokok') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('positions.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const gajiInput = document.getElementById('gaji');
    
    gajiInput.addEventListener('input', function(e) {
        // Hapus karakter non-angka
        let value = this.value.replace(/[^\d]/g, '');
        
        // Format dengan titik sebagai pemisah ribuan
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        
        // Set kembali nilai yang diformat
        this.value = value;
    });

    // Tambahkan validasi sebelum submit
    const form = gajiInput.closest('form');
    form.addEventListener('submit', function(e) {
        // Hapus format mata uang sebelum submit
        let cleanValue = gajiInput.value.replace(/[^\d]/g, '');
        gajiInput.value = cleanValue;
    });
});
</script>
@endpush