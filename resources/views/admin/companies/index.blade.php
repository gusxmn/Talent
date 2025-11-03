@extends('admin.layout') 

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4 text-gray-800">Manajemen Perusahaan</h1>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Perusahaan</h6>
                    <a href="{{ route('admin.companies.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas"></i> Tambah Perusahaan
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Industri</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $company)
                                <tr>
                                    <td class="text-center">
                                        @if ($company->logo)
                                            <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->nama }}" style="height: 40px; width: auto; object-fit: contain;">
                                        @else
                                            <i class="fas fa-building fa-2x text-secondary"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $company->nama }}</strong><br>
                                        <small class="text-muted">{{ $company->slug }}</small>
                                    </td>
                                    <td>{{ $company->industri }}</td>
                                    <td>{{ $company->email ?? '-' }}</td>
                                    <td>
                                        @if($company->is_active)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Non-Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus perusahaan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data perusahaan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection