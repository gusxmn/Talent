@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-geo-alt-fill me-2"></i>Tambah Lokasi</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.lokasi.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Negara <span class="text-danger">*</span></label>
                                <input type="text" name="negara" 
                                    class="form-control @error('negara') is-invalid @enderror"
                                    value="{{ old('negara', 'Indonesia') }}" required>
                                @error('negara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                <input type="text" name="provinsi" 
                                    class="form-control @error('provinsi') is-invalid @enderror"
                                    value="{{ old('provinsi') }}" required>
                                @error('provinsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kabupaten</label>
                                <input type="text" name="kabupaten" 
                                    class="form-control @error('kabupaten') is-invalid @enderror"
                                    value="{{ old('kabupaten') }}">
                                @error('kabupaten')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" 
                                    class="form-control @error('kecamatan') is-invalid @enderror"
                                    value="{{ old('kecamatan') }}">
                                @error('kecamatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kelurahan</label>
                                <input type="text" name="kelurahan" 
                                    class="form-control @error('kelurahan') is-invalid @enderror"
                                    value="{{ old('kelurahan') }}">
                                @error('kelurahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Desa</label>
                                <input type="text" name="desa" 
                                    class="form-control @error('desa') is-invalid @enderror"
                                    value="{{ old('desa') }}">
                                @error('desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" name="kode_pos" 
                                    class="form-control @error('kode_pos') is-invalid @enderror"
                                    value="{{ old('kode_pos') }}">
                                @error('kode_pos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('admin.lokasi.index') }}" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left"></i> batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Bootstrap Icons CDN (jika belum ada di layout) --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection
