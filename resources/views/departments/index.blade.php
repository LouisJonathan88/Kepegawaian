@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('layouts.sidebar')

        <main class="col-md-10 ms-sm-auto px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Departemen</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('departments.create') }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Departemen
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
                    <form action="{{ route('departments.index') }}" method="GET" class="d-flex">
                        <input type="search" name="search" class="form-control me-2" 
                               placeholder="Cari Departemen (Nama)" 
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
                            <th>Nama Departemen</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Pegawai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $index => $department)
                        <tr>
                            <td class="text-center">{{ $departments->firstItem() + $index }}</td>
                            <td>{{ $department->nama_departemen }}</td>
                            <td>
                                @if($department->deskripsi)
                                    {{ $department->deskripsi}}
                                @else
                                    <span class="text-muted fst-italic">Tidak ada deskripsi</span>
                                @endif
                            </td>
                            <td>{{ $department->employees_count }} Pegawai</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('departments.edit', $department->id) }}" 
                                       class="btn btn-sm btn-outline-warning me-1" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit Departemen">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('departments.destroy', $department->id) }}" 
                                          method="POST" 
                                          class="d-inline delete-form"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus departemen ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                data-bs-toggle="tooltip" 
                                                title="Hapus Departemen">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="alert alert-warning">
                                        Tidak ada data departemen yang ditemukan.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Menampilkan {{ $departments->firstItem() }} - {{ $departments->lastItem() }} dari {{ $departments->total() }} data
                </div>
                {{ $departments->appends(request()->input())->links() }}
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