@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Lokasi</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Negara:</strong> {{ $lokasi->negara }}</p>
            <p><strong>Provinsi:</strong> {{ $lokasi->provinsi }}</p>
            <p><strong>Kabupaten:</strong> {{ $lokasi->kabupaten }}</p>
            <p><strong>Kecamatan:</strong> {{ $lokasi->kecamatan }}</p>
            <p><strong>Kelurahan:</strong> {{ $lokasi->kelurahan }}</p>
            <p><strong>Desa:</strong> {{ $lokasi->desa }}</p>
            <p><strong>Kode Pos:</strong> {{ $lokasi->kode_pos }}</p>
        </div>
    </div>

    <a href="{{ route('admin.lokasi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
