@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('layouts.sidebar')

        <main class="col-md-10 ms-sm-auto px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Jabatan</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('positions.create') }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Jabatan
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('positions.index') }}" method="GET" class="d-flex">
                        <input type="search" name="search" class="form-control me-2" 
                               placeholder="Cari Jabatan (Nama/Departemen)" 
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
                            <th>Nama Jabatan</th>
                            <th>Nama Departemen</th>
                            <th>Deskripsi</th>
                            <th>Gaji</th>
                            <th>Jumlah Pegawai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($positions as $index => $position)
                        <tr>
                            <td class="text-center">{{ $positions->firstItem() + $index }}</td>
                            <td>{{ $position->nama_jabatan }}</td>
                            <td>
                                @if($position->department)
                                    {{ $position->department->nama_departemen }}
                                @else
                                    <span class="text-muted fst-italic">Tidak ada departemen</span>
                                @endif
                            </td>
                            <td>
                                @if($position->deskripsi)
                                    {{ $position->deskripsi }}
                                @else
                                    <span class="text-muted fst-italic">Tidak ada deskripsi</span>
                                @endif
                            </td>
                            <td>Rp.{{ number_format($position->gaji_pokok, 0, ',', '.') }}</td>
                            <td>{{ $position->employees_count }} Pegawai</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('positions.edit', $position->id) }}" 
                                       class="btn btn-sm btn-outline-warning me-1" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit Jabatan">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('positions.destroy', $position->id) }}" 
                                          method="POST" 
                                          class="d-inline delete-form"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="tooltip" 
                                                title="Hapus Jabatan">
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
                                        Tidak ada data jabatan yang ditemukan.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Menampilkan {{ $positions->firstItem() }} - {{ $positions->lastItem() }} dari {{ $positions->total() }} data
                </div>
                {{ $positions->appends(request()->input())->links() }}
            </div>
        </main>
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
});
</script>
@endpush