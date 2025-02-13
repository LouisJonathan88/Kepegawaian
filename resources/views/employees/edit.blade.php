@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Konten Utama -->
        <main class="col-md-10 ms-sm-auto px-md-4">
            <div class="container">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Edit Data Pegawai</h1>
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

                <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" 
                                   value="{{ old('nip', $employee->nip) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                                   value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki" {{ $employee->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $employee->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email', $employee->email) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="department_id" class="form-label">Departemen</label>
                            <select class="form-control" id="department_id" name="department_id" required>
                                <option value="">Pilih Departemen</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                        {{ $department->nama_departemen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="position_id" class="form-label">Jabatan</label>
                            <select class="form-control" id="position_id" name="position_id" required>
                                <option value="">Pilih Jabatan</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ $employee->position_id == $position->id ? 'selected' : '' }}>
                                        {{ $position->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="gaji" class="form-label">Gaji</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="gaji" name="gaji" 
                                   value="Rp {{ number_format($employee->gaji, 0, ',', '.') }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const gaji = document.getElementById('gaji');
    
    gaji.addEventListener('input', function(e) {
        // Hapus karakter non-angka
        let value = this.value.replace(/[^\d]/g, '');
        
        // Format dengan titik sebagai pemisah ribuan
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        
        // Tambahkan 'Rp' di depan
        this.value = 'Rp ' + value;
    });

    // Tambahkan validasi sebelum submit
    const form = gaji.closest('form');
    form.addEventListener('submit', function(e) {
        // Hapus format mata uang sebelum submit
        let cleanValue = gaji.value.replace(/[^\d]/g, '');
        gaji.value = cleanValue;
    });
});
</script>
@endpush