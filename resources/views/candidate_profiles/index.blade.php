@extends('layouts.app')

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-lg p-4">

        <div class="text-center mb-4">
            <img src="{{ $user->avatar ? asset('storage/avatars/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.$user->name }}"
                 class="rounded-circle mb-3" width="140" height="140">

            <h3 class="fw-bold">{{ $user->name }}</h3>
            <p class="text-muted">{{ $user->email }}</p>
        </div>

        <hr>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">WhatsApp</label>
                    <input type="text" class="form-control" name="whatsapp" value="{{ $user->whatsapp }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" class="form-control" name="lokasi" value="{{ $user->lokasi }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-control" name="gender">
                        <option value="">- Pilih -</option>
                        <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Foto Profil</label>
                    <input type="file" class="form-control" name="avatar">
                </div>

            </div>

            <div class="text-end">
                <button class="btn btn-primary px-4">Simpan Profil</button>
            </div>

        </form>
    </div>
</div>
@endsection
