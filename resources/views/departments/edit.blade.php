@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('layouts.sidebar')

        <main class="col-md-10 ms-sm-auto px-md-4">
            <div class="container">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Edit Departemen</h1>
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

                <form action="{{ route('departments.update', $department->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_departemen" class="form-label">Nama Departemen</label>
                        <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" 
                               value="{{ old('nama_departemen', $department->nama_departemen) }}" required>
                    </div>
                
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $department->deskripsi) }}</textarea>
                    </div>
                
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection