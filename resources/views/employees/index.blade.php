@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('layouts.sidebar')

        <main class="col-md-10 ms-sm-auto px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Pegawai</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('employees.create') }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Pegawai
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Form Pencarian --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('employees.index') }}" method="GET" class="d-flex">
                        <input type="search" name="search" class="form-control me-2" 
                               placeholder="Cari Pegawai (Nama, NIP, Departemen, Jabatan)" 
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-primary">
                            Cari
                        </button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Departemen</th>
                            <th>Jabatan</th>
                            <th>Gaji</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $index => $employee)
                        <tr>
                            <td class="text-center">{{ $employees->firstItem() + $index }}</td>
                            <td>{{ $employee->nip }}</td>
                            <td>{{ $employee->nama_lengkap }}</td>
                            <td>
                                @if($employee->department)
                                    {{ $employee->department->nama_departemen }}
                                @else
                                    <span class="text-muted fst-italic">Tidak ada departemen</span>
                                @endif
                            </td>
                            <td>
                                @if($employee->position)
                                    {{ $employee->position->nama_jabatan }}
                                @else
                                    <span class="text-muted fst-italic">Tidak ada jabatan</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($employee->gaji, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-info me-1 btn-detail" 
                                        data-id="{{ $employee->id }}"
                                        title="Detail Pegawai">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('employees.edit', $employee->id) }}" 
                                       class="btn btn-sm btn-outline-warning me-1" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit Pegawai">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" 
                                          method="POST" 
                                          class="d-inline delete-form"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pegawai ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="tooltip" 
                                                title="Hapus Pegawai">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    <div class="alert alert-warning">
                                        Tidak ada data pegawai yang ditemukan.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Menampilkan {{ $employees->firstItem() }} - {{ $employees->lastItem() }} dari {{ $employees->total() }} data
                </div>
                {{ $employees->appends(request()->input())->links() }}
            </div>
        </main>
    </div>
</div>

<!-- Modal Detail Pegawai -->
<div class="modal fade" id="employeeDetailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detail Pegawai</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="employeeDetailContent">
                <!-- Konten akan diisi secara dinamis -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Handler untuk tombol detail
    const detailButtons = document.querySelectorAll('.btn-detail');
    const employeeDetailModal = new bootstrap.Modal(document.getElementById('employeeDetailModal'));
    const employeeDetailContent = document.getElementById('employeeDetailContent');

    detailButtons.forEach(button => {
        button.addEventListener('click', function() {
            const employeeId = this.getAttribute('data-id');
            
            // Kirim permintaan AJAX untuk mendapatkan detail pegawai
            fetch(`/employees/${employeeId}/detail`)
                .then(response => response.json())
                .then(employee => {
                    // Bangun konten modal
                    const content = `
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="30%">NIP</th>
                                        <td>${employee.nip}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>${employee.nama_lengkap}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>
                                            <span class="badge ${employee.jenis_kelamin === 'L' ? 'bg-primary' : 'bg-danger'}">
                                                ${employee.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>${employee.email ? `<a href="mailto:${employee.email}">${employee.email}</a>` : '<span class="text-muted fst-italic">Tidak ada email</span>'}</td>
                                    </tr>
                                    <tr>
                                        <th>Departemen</th>
                                        <td>${employee.department ? employee.department.nama_departemen : '<span class="text-muted fst-italic">Tidak ada departemen</span>'}</td>
                                    </tr>
                                    <tr>
                                        <th>Jabatan</th>
                                        <td>${employee.position ? employee.position.nama_jabatan : '<span class="text-muted fst-italic">Tidak ada jabatan</span>'}</td>
                                    </tr>
                                    <tr>
                                        <th>Gaji</th>
                                        <td>Rp ${new Intl.NumberFormat('id-ID').format(employee.gaji)}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    `;
                    
                    employeeDetailContent.innerHTML = content;
                    employeeDetailModal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat detail pegawai');
                });
        });
    });
});
</script>
@endpush