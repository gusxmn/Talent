@extends('admin.layout')

@section('title', 'Tambah Provinsi')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Provinsi Baru</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.reference.provinsi.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id">Kode Provinsi</label>
                            <input type="text" class="form-control @error('id') is-invalid @enderror" 
                                   id="id" name="id" 
                                   value="{{ old('id') }}" required maxlength="10"
                                   placeholder="Contoh: 11, 12, 13">
                            @error('id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Kode provinsi harus unik dan maksimal 10 karakter</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama Provinsi</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" 
                                   value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.reference.provinsi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection