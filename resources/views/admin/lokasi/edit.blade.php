@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Lokasi</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.lokasi.update', $lokasi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Negara <span class="text-danger">*</span></label>
                                <input type="text" name="negara" 
                                    class="form-control @error('negara') is-invalid @enderror"
                                    value="{{ old('negara', $lokasi->negara) }}" required>
                                @error('negara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                <input type="text" name="provinsi" 
                                    class="form-control @error('provinsi') is-invalid @enderror"
                                    value="{{ old('provinsi', $lokasi->provinsi) }}" required>
                                @error('provinsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kabupaten</label>
                                <input type="text" name="kabupaten" 
                                    class="form-control @error('kabupaten') is-invalid @enderror"
                                    value="{{ old('kabupaten', $lokasi->kabupaten) }}">
                                @error('kabupaten')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" 
                                    class="form-control @error('kecamatan') is-invalid @enderror"
                                    value="{{ old('kecamatan', $lokasi->kecamatan) }}">
                                @error('kecamatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kelurahan</label>
                                <input type="text" name="kelurahan" 
                                    class="form-control @error('kelurahan') is-invalid @enderror"
                                    value="{{ old('kelurahan', $lokasi->kelurahan) }}">
                                @error('kelurahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Desa</label>
                                <input type="text" name="desa" 
                                    class="form-control @error('desa') is-invalid @enderror"
                                    value="{{ old('desa', $lokasi->desa) }}">
                                @error('desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" name="kode_pos" 
                                    class="form-control @error('kode_pos') is-invalid @enderror"
                                    value="{{ old('kode_pos', $lokasi->kode_pos) }}">
                                @error('kode_pos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('admin.lokasi.index') }}" class="btn btn-secondary me-2">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
