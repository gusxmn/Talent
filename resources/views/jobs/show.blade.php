<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title ?? 'Lowongan Pekerjaan' }} - {{ $job->company ?? config('app.name') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { 
            background: #f8f9fa; 
            font-family: Arial, sans-serif; 
        }
        .job-card-main { 
            background: white; 
            padding: 1.5rem; 
            border-radius: 0; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); 
            margin-top: 0; 
        }
        .custom-breadcrumb { 
            padding: 0; 
            margin-bottom: 1rem; 
            font-size: 0.85rem; 
            color: #6c757d;
        }
        .custom-breadcrumb a { 
            color: #0d6efd; 
            text-decoration: none; 
        }
        .custom-breadcrumb .breadcrumb-separator { 
            margin: 0 0.25rem; 
            color: #999; 
        }
        .company-logo-small { 
            width: 60px; 
            height: 60px; 
            object-fit: contain; 
            border-radius: 8px; 
            margin-right: 15px; 
            border: 1px solid #e9ecef;
            background: white;
            padding: 5px;
        }
        .logo-placeholder {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1rem;
            margin-right: 15px;
        }
        .job-title { 
            font-size: 1.25rem; 
            font-weight: 700; 
            color: #333; 
            margin-bottom: 0.25rem; 
        }
        .company-name-small { 
            font-size: 0.95rem; 
            color: #333; 
            font-weight: 500; 
        }
        .salary-info { 
            font-size: 1rem; 
            font-weight: 600; 
            color: #333; 
            margin-bottom: 1rem; 
        }
        .short-info-item { 
            display: flex; 
            align-items: flex-start; 
            margin-bottom: 0.5rem; 
            font-size: 0.95rem; 
            color: #495057; 
        }
        .short-info-item i { 
            color: #6c757d; 
            margin-right: 10px; 
            font-size: 1rem; 
            width: 15px; 
            line-height: 1.3; 
        }
        .badge-hot-job { 
            background-color: #ffc107; 
            color: #333; 
            font-weight: 700; 
            padding: 0.3em 0.7em; 
            border-radius: 5px; 
            font-size: 0.7rem; 
        }
        .badge-active-recruit { 
            background-color: #28a745; 
            color: white; 
            font-weight: 700; 
            padding: 0.3em 0.7em; 
            border-radius: 5px; 
            font-size: 0.7rem; 
        }
        .requirements, .skills-section { 
            margin-top: 1rem; 
        }
        .section-title { 
            font-size: 1.25rem; 
            font-weight: 700; 
            color: #333; 
            margin-bottom: 1rem; 
        }
        .job-description {
            line-height: 1.6;
            color: #495057;
        }
        .sidebar-job-card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.07);
            transition: all .2s;
        }
        .sidebar-job-card:hover {
            transform: translateY(-3px);
        }
        .sticky-sidebar {
            position: sticky;
            top: 80px;
        }
        /* Perbaikan untuk Tombol Aksi */
.btn-group-actions {
    margin-top: 1.5rem;
    flex-wrap: wrap;
}

/* === CHAT APPLY BUTTON === */
.btn-chat-apply {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 0.55rem 1.25rem;   /* KECILKAN */
    border-radius: 7px;         /* KECILKAN */
    font-weight: 600;
    font-size: 0.9rem;          /* KECILKAN */
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.35); /* KECILKAN */
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-chat-apply::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-chat-apply:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
    transform: translateY(-2px) scale(1.03); /* DIPERKECIL */
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.5);
}

/* === APPLY ONLY BUTTON === */
.btn-apply-only {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 0.55rem 1.25rem;  /* KECILKAN */
    border-radius: 7px;        /* KECILKAN */
    font-weight: 600;
    font-size: 0.9rem;         /* KECILKAN */
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(40,167,69,0.35); /* KECILKAN */
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-apply-only:hover {
    background-color: #218838;
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.5);
}

/* === SECONDARY ICON BUTTON === */
.btn-secondary-icon {
    background-color: #6c757d;
    color: white;
    border: none;
    padding: 0.55rem;   /* KECILKAN */
    border-radius: 50%;
    width: 38px;        /* KECILKAN */
    height: 38px;       /* KECILKAN */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(108,117,125,0.35);
    transition: all 0.3s ease;
}

.btn-secondary-icon i {
    font-size: 1rem; /* KECILKAN */
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .btn-group-actions {
        flex-direction: column;
        align-items: stretch;
    }
    .btn-chat-apply, .btn-apply-only {
        width: 100%;
        margin-bottom: 0.5rem;
    }
    .btn-secondary-icon {
        align-self: center;
        margin: 0.25rem;
    }
}

    </style>
</head>
<body>

@include('partials.navbar')

<div class="container mt-4">
    <div class="row">

         {{-- ============================= --}}
    {{--            KOLOM KIRI         --}}
    {{-- ============================= --}}
    <div class="col-lg-8 col-12">

        <nav class="custom-breadcrumb mt-4 text-start" aria-label="breadcrumb">
            <a href="{{ route('jobs.index') }}">Pekerjaan</a>
            <span class="breadcrumb-separator">/</span>
            {{-- Menggunakan location_string yang sudah diolah di Controller --}}
            <a href="#">{{ $job->location_string ?? 'Lokasi Tidak Diketahui' }}</a>
            <span class="breadcrumb-separator">/</span>
            <span>{{ $job->title ?? 'Detail Pekerjaan' }}</span>
        </nav>

        <div class="job-card-main">

            {{-- 2. Logo, Title, and Company Info --}}
            <div class="d-flex align-items-center mb-3">
                {{-- Logo dengan fallback handling --}}
                @if($job->company_logo && Storage::disk('public')->exists($job->company_logo))
                    <img src="{{ asset('storage/' . $job->company_logo) }}" 
                         alt="Logo {{ $job->company ?? 'Perusahaan' }}" 
                         class="company-logo-small"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="logo-placeholder" style="display: none;">
                        {{ substr($job->company ?? 'CO', 0, 2) }}
                    </div>
                @else
                    <div class="logo-placeholder">
                        {{ substr($job->company ?? 'CO', 0, 2) }}
                    </div>
                @endif
                
                <div>
                    <h1 class="job-title mb-0">{{ $job->title ?? 'Judul Tidak Ada' }}</h1>
                    <p class="company-name-small mb-0">
                        {{ $job->company ?? 'Nama Perusahaan' }} 
                        @if(($job->is_verified ?? false))
                            <i class="bi bi-check-circle-fill verified-icon"></i>
                        @endif
                    </p>
                </div>
            </div>

            {{-- 3. Salary --}}
            <p class="salary-info mb-3">
                {{ $job->formatted_salary ?? 'Gaji Tidak Ditampilkan' }}
                @if ($job->formatted_salary)
                    /Bulan
                @endif
            </p>

            {{-- 4. Short Job Meta Info --}}
            <div class="mb-3">
                <div class="short-info-item">
                    <i class="bi bi-briefcase"></i>
                    <span>Jenis Pekerjaan: <span class="text-category">{{ ucfirst($job->type ?? 'Tidak Diketahui') }}</span></span>
                </div>
                <div class="short-info-item">
                    <i class="bi bi-clock"></i>
                    <span class="text-policy">
                        @if($job->work_policy == 'kerja_di_kantor')
                            Kerja di Kantor
                        @elseif($job->work_policy == 'remote')
                            Remote
                        @elseif($job->work_policy == 'hybrid')
                            Hybrid
                        @else
                            {{ ucfirst($job->work_policy ?? 'Tidak Diketahui') }}
                        @endif
                        - 
                        {{ ucfirst($job->type ?? 'Tidak Diketahui') }}
                    </span>
                </div>
                <div class="short-info-item">
                    <i class="bi bi-mortarboard"></i>
                    {{-- Menggunakan formatted_education dari Controller --}}
                    <span class="text-policy">Minimal {{ $job->formatted_education ?? 'Tidak Diketahui' }}</span>
                </div>
                <div class="short-info-item">
                    <i class="bi bi-person-badge"></i>
                    <span class="text-policy">
                        Pengalaman: 
                        @php
                            $experience = $job->experience_level ?? 'Tidak Diketahui';
                            // 1. Mengganti underscore menjadi spasi
                            $experience = str_replace('_', ' ', $experience); 
                            // 2. Mengganti spasi (di antara angka) dengan tanda hubung
                            $experience = str_replace(' ', ' - ', $experience);
                            // 3. Menghilangkan " - tahun" di akhir jika ada, lalu menempelkan kembali "tahun"
                            // (Asumsi string dari backend adalah "5 10" atau "5_10")
                            // Jika string dari backend adalah "5 10 tahun" dan Anda hanya ingin mengganti spasi:
                            $experience = str_replace(' - tahun', ' tahun', $experience); 
                        @endphp
                        {{ ucfirst(trim($experience)) }}
                    </span>
                </div>
            </div>

            {{-- 5. Status Badges --}}
            <div class="d-flex gap-2 mb-4">
                @if(($job->is_hot_job ?? false))
                    <span class="badge-hot-job">HOT JOB</span>
                @endif
                <span class="badge-active-recruit">AKTIF MEREKRUT</span>
                @if($job->created_at && $job->created_at->greaterThan(\Carbon\Carbon::now()->subDays(3)))
                    <span class="badge-new-job">BARU</span>
                @endif
            </div>

            {{-- 6. Footer Info --}}
            <div class="footer-info d-flex align-items-center mb-4">
                <span><i class="bi bi-calendar3 me-1"></i>Tayang {{ $job->created_at ? $job->created_at->diffForHumans() : 'sejak lama' }}</span>
                <span class="updated-at ms-3"><i class="bi bi-arrow-clockwise me-1"></i>Diperbarui {{ $job->updated_at ? $job->updated_at->diffForHumans() : 'Tidak Diketahui' }}</span>
            </div>
            
            {{-- Tombol Aksi --}}
            <div class="btn-group-actions">
                <a href="{{ route('jobs.apply', $job->id ?? '#') }}" class="btn-chat-apply me-2">
                    <i class="bi bi-send-check me-2"></i>Lamar 1x Tap Di Aplikasi
                </a>
                <a href="{{ route('jobs.apply', $job->id ?? '#') }}" class="btn-apply-only me-2">
                    <i class="bi bi-send me-2"></i>LAMAR
                </a>
                <button class="btn btn-secondary-icon me-2" onclick="saveJob()" title="Simpan Lowongan">
                    <i class="bi bi-bookmark"></i>
                </button>
                <button class="btn btn-secondary-icon" onclick="shareJob()" title="Bagikan Lowongan">
                    <i class="bi bi-share"></i>
                </button>
            </div>

            <hr class="my-5">

            {{-- Persyaratan --}}
            <h3 class="section-title">Persyaratan</h3>
            <ul>
                @foreach($job->custom_requirements_list ?? [] as $req)
                    <li>{{ $req }}</li>
                @endforeach
            </ul>

            <hr class="my-5">

            {{-- Skills --}}
            @if(!empty($job->skills_list))
                <h3 class="section-title">Keterampilan yang Dibutuhkan</h3>
                <ul>
                    @foreach($job->skills_list as $skill)
                        <li>{{ $skill }}</li>
                    @endforeach
                </ul>
                <hr class="my-5">
            @endif

            {{-- Deskripsi --}}
            <h3 class="section-title">Deskripsi Pekerjaan</h3>
            <div class="job-description">
                {!! nl2br(e($job->description)) !!}
            </div>

        </div>
    </div>

    {{-- ============================= --}}
    {{--           KOLOM KANAN         --}}
    {{-- ============================= --}}
    <div class="col-lg-4 col-12 mt-4 mt-lg-0">
        <div class="sticky-sidebar">
            <h5 class="fw-bold mb-3">Lowongan Lainnya</h5>

            @foreach($relatedJobs as $r)
            <a href="{{ route('jobs.show', $r->id) }}" class="text-decoration-none">
                <div class="card sidebar-job-card mb-3">
                    <div class="card-body py-3">

                        <h6 class="fw-semibold mb-1">{{ $r->title }}</h6>

                        <div class="text-muted small">
                            <i class="bi bi-building me-1"></i>{{ $r->company }}
                        </div>

                        <div class="fw-bold mt-1 small">
                            {{ $r->formatted_salary ?? 'Gaji tidak ditampilkan' }}
                        </div>

                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

</div>
</div>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
