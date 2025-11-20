<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kandidat: {{ $profile->user->name ?? 'N/A' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    {{-- 1. INCLUDE NAVBAR PARTIAL --}}
    @include('partials.navbar') 

    <div class="container my-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Profil Kandidat: {{ $profile->user->name ?? 'N/A' }}</h2>
                    </div>
                    <div class="card-body">

                        {{-- --- Data Profil Dasar --- --}}
                        <h4 class="text-primary mt-2">Informasi Dasar</h4>
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p><strong>Nama Pengguna:</strong> {{ $profile->user->name ?? 'N/A' }}</p>
                                <p><strong>Email:</strong> {{ $profile->user->email ?? 'N/A' }}</p>
                                <p><strong>Jenis Kelamin:</strong> {{ $profile->gender ?? '-' }}</p>
                                <p><strong>Tanggal Lahir:</strong> {{ $profile->birth_date ? \Carbon\Carbon::parse($profile->birth_date)->format('d F Y') : '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Gaji Ekspektasi:</strong> Rp{{ number_format($profile->expected_salary_min ?? 0, 0, ',', '.') }} - Rp{{ number_format($profile->expected_salary_max ?? 0, 0, ',', '.') }}</p>
                                <p><strong>Level Pekerjaan:</strong> {{ $profile->job_level ?? '-' }}</p>
                                <p><strong>Tipe Pekerjaan:</strong> {{ $profile->work_type_preference ?? '-' }}</p>
                                <p><strong>CV File:</strong> @if($profile->cv_file) <a href="{{ Storage::url($profile->cv_file) }}" target="_blank">Lihat CV</a> @else - @endif</p>
                            </div>
                            <div class="col-12">
                                <p><strong>Alamat:</strong> {{ $profile->address ?? '-' }}, {{ $profile->city ?? '-' }}, {{ $profile->province ?? '-' }}</p>
                            </div>
                        </div>
                        
                        {{-- --- Tentang Saya --- --}}
                        <h4 class="text-primary mt-4">Tentang Saya</h4>
                        <hr>
                        <p class="card p-3 bg-light">{{ $profile->about_me ?? 'Belum ada deskripsi tentang diri.' }}</p>

                        {{-- --- Tautan Sosial/Portofolio --- --}}
                        <h4 class="text-primary mt-4">Tautan & Portofolio</h4>
                        <hr>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Portofolio:</strong> @if($profile->portfolio_url) <a href="{{ $profile->portfolio_url }}" target="_blank">{{ $profile->portfolio_url }}</a> @else - @endif</li>
                            <li class="list-group-item"><strong>LinkedIn:</strong> @if($profile->linkedin_url) <a href="{{ $profile->linkedin_url }}" target="_blank">{{ $profile->linkedin_url }}</a> @else - @endif</li>
                            <li class="list-group-item"><strong>GitHub:</strong> @if($profile->github_url) <a href="{{ $profile->github_url }}" target="_blank">{{ $profile->github_url }}</a> @else - @endif</li>
                        </ul>

                        {{-- --- Riwayat Pendidikan (Memerlukan Eager Loading: user.educations) --- --}}
                        @if (isset($profile->user->educations) && $profile->user->educations->count())
                            <h4 class="text-primary mt-4">Riwayat Pendidikan</h4>
                            <hr>
                            @foreach ($profile->user->educations as $education)
                                <div class="card mb-3 p-3">
                                    <div class="d-flex justify-content-between">
                                        <h5>{{ $education->school_name }}</h5>
                                        <span class="badge bg-secondary">{{ $education->start_date }} - {{ $education->end_date ?? 'Sekarang' }}</span>
                                    </div>
                                    <p class="mb-1">**{{ $education->degree ?? '-' }}** di {{ $education->field_of_study }}</p>
                                    @if($education->grade) <p class="mb-0 text-muted"><small>Nilai/IPK: {{ $education->grade }}</small></p> @endif
                                    @if($education->description) <p class="mt-2">{{ $education->description }}</p> @endif
                                </div>
                            @endforeach
                        @endif

                        {{-- --- Pengalaman Kerja (Memerlukan Eager Loading: user.experiences) --- --}}
                        @if (isset($profile->user->experiences) && $profile->user->experiences->count())
                            <h4 class="text-primary mt-4">Pengalaman Kerja</h4>
                            <hr>
                            @foreach ($profile->user->experiences as $experience)
                                <div class="card mb-3 p-3">
                                    <div class="d-flex justify-content-between">
                                        <h5>{{ $experience->position }} di {{ $experience->company_name }}</h5>
                                        <span class="badge bg-secondary">{{ $experience->start_date }} - @if($experience->is_current_job) Sekarang @else {{ $experience->end_date ?? 'N/A' }} @endif</span>
                                    </div>
                                    <p class="text-muted">{{ $experience->employment_type ?? 'Full-time' }}</p>
                                    <p class="mt-2">**Deskripsi Pekerjaan:** {{ $experience->job_description }}</p>
                                    @if($experience->achievements) <p>**Pencapaian:** {{ $experience->achievements }}</p> @endif
                                </div>
                            @endforeach
                        @endif
                        
                        {{-- *Lanjutkan untuk Skills, Certifications, Projects, dan Languages* --}}

                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                        {{-- Asumsi route edit sudah didefinisikan --}}
                        <a href="{{ route('candidate_profiles.edit', $profile->id) }}" class="btn btn-warning">Edit Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. INCLUDE FOOTER PARTIAL --}}
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>