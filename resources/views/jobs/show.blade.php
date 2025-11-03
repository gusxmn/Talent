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
        .company-name-small .verified-icon { 
            color: #28a745; 
            margin-left: 5px; 
            font-size: 0.9rem; 
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
        .short-info-item span .text-category { 
            color: #0d6efd; 
            font-weight: 600; 
        }
        .short-info-item span .text-policy { 
            color: #495057; 
        }
        .badge-hot-job { 
            background-color: #ffc107; 
            color: #333; 
            font-weight: 700; 
            padding: 0.3em 0.7em; 
            border-radius: 5px; 
            font-size: 0.7rem; 
            line-height: 1; 
        }
        .badge-active-recruit { 
            background-color: #28a745; 
            color: white; 
            font-weight: 700; 
            padding: 0.3em 0.7em; 
            border-radius: 5px; 
            font-size: 0.7rem; 
            line-height: 1; 
        }
        .footer-info { 
            font-size: 0.8rem; 
            color: #6c757d; 
            margin-top: 1rem; 
            padding-top: 0.5rem; 
        }
        .footer-info .updated-at { 
            color: #0d6efd; 
            font-weight: 500; 
        }
        .action-buttons { 
            margin-top: 1rem; 
            padding-top: 1rem; 
            border-top: 1px solid #eee; 
        }
        .btn-chat-apply { 
            background-color: #0d6efd; 
            color: white; 
            font-weight: 600; 
            padding: 0.75rem 1rem; 
            border-radius: 5px; 
            font-size: 0.9rem; 
            flex-grow: 1; 
            transition: background-color 0.2s; 
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-apply-only { 
            background-color: white; 
            color: #0d6efd; 
            border: 1px solid #0d6efd; 
            font-weight: 600; 
            padding: 0.75rem 1rem; 
            border-radius: 5px; 
            font-size: 0.9rem; 
            flex-grow: 1; 
            transition: background-color 0.2s; 
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-secondary-icon { 
            color: #6c757d; 
            border: 1px solid #ced4da; 
            padding: 0.75rem 1rem; 
            border-radius: 5px; 
            margin-left: 0.5rem; 
            transition: all 0.2s; 
            line-height: 1.5; 
            background: white;
        }
        .requirement-badges-container { 
            display: flex; 
            flex-wrap: wrap; 
            gap: 8px; 
            margin-top: 1rem; 
            margin-bottom: 2rem; 
        }
        .job-requirement-badge { 
            background-color: #f1f1f1; 
            color: #333; 
            padding: 8px 15px; 
            border-radius: 5px; 
            font-size: 0.9rem; 
            font-weight: 500; 
            white-space: nowrap; 
        }
        .skills-section { 
            margin-top: 1rem; 
            margin-bottom: 2rem; 
        }
        .skills-header { 
            font-size: 1.25rem; 
            font-weight: 700; 
            color: #333; 
            margin-bottom: 1rem; 
        }
        .skills-badges-container { 
            display: flex; 
            flex-wrap: wrap; 
            gap: 8px; 
        }
        .skill-badge { 
            background-color: #f1f1f1; 
            color: #333; 
            padding: 8px 15px; 
            border-radius: 5px; 
            font-size: 0.9rem; 
            font-weight: 500; 
            white-space: nowrap; 
        }
        .skill-badge-icon { 
            color: #0d6efd; 
            font-size: 1.1rem; 
            margin-right: 5px; 
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
        @media (max-width: 768px) {
            .action-buttons { 
                flex-direction: column; 
                gap: 10px; 
            }
            .btn-secondary-icon { 
                margin-left: 0; 
                margin-top: 5px; 
            }
            .footer-info { 
                flex-direction: column; 
                gap: 5px; 
            }
            .company-logo-small {
                width: 50px;
                height: 50px;
            }
            .logo-placeholder {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>
<body>

    @include('partials.navbar')

    <div class="container" style="max-width: 900px;">
        <div class="row justify-content-start"> <!-- Changed from justify-content-center to justify-content-start -->
            <div class="col-12">
                <div class="job-card-main">

                    {{-- 1. Breadcrumb Row --}}
                    <nav class="custom-breadcrumb" aria-label="breadcrumb">
                        <a href="{{ route('jobs.index') }}">Pekerjaan</a>
                        <span class="breadcrumb-separator">/</span>
                        {{-- Menggunakan location_string yang sudah diolah di Controller --}}
                        <a href="#">{{ $job->location_string ?? 'Lokasi Tidak Diketahui' }}</a>
                        <span class="breadcrumb-separator">/</span>
                        <span>{{ $job->title ?? 'Detail Pekerjaan' }}</span>
                    </nav>

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
                                • 
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
                            <span class="text-policy">Pengalaman: {{ ucfirst(str_replace('_', ' ', $job->experience_level ?? 'Tidak Diketahui')) }}</span>
                        </div>
                        <div class="short-info-item">
                            <i class="bi bi-geo-alt"></i>
                            <span class="text-policy">Lokasi: {{ $job->location_string ?? 'Lokasi Tidak Diketahui' }}</span>
                        </div>
                    </div>

                    {{-- 5. Status Badges --}}
                    <div class="d-flex gap-2 mb-4">
                        @if(($job->is_hot_job ?? false))
                            <span class="badge-hot-job">HOT JOB</span>
                        @endif
                        <span class="badge-active-recruit">AKTIF MEREKRUT</span>
                        @if($job->created_at && $job->created_at->greaterThan(\Carbon\Carbon::now()->subDays(3)))
                            <span class="badge-hot-job" style="background-color: #dc3545; color: white;">BARU</span>
                        @endif
                    </div>

                    {{-- 6. Footer Info --}}
                    <div class="footer-info d-flex align-items-center mb-4">
                        <span><i class="bi bi-calendar3 me-1"></i>Tayang {{ $job->created_at ? $job->created_at->diffForHumans() : 'sejak lama' }}</span>
                        <span class="updated-at ms-3"><i class="bi bi-arrow-clockwise me-1"></i>Diperbarui {{ $job->updated_at ? $job->updated_at->diffForHumans() : 'Tidak Diketahui' }}</span>
                    </div>
                    
                    {{-- 7. Action Buttons --}}
                    <div class="d-flex align-items-center action-buttons">
                        <a href="{{ route('jobs.apply', $job->id ?? '#') }}" class="btn-chat-apply me-2">
                            <i class="bi bi-send-check me-2"></i>LAMAR & CHAT
                        </a>

                        <a href="{{ route('jobs.apply', $job->id ?? '#') }}" class="btn-apply-only me-2">
                            <i class="bi bi-send me-2"></i>LAMAR
                        </a>

                        <button class="btn btn-secondary-icon" onclick="saveJob()" title="Simpan Lowongan">
                            <i class="bi bi-bookmark"></i>
                        </button>
                        <button class="btn btn-secondary-icon" onclick="shareJob()" title="Bagikan Lowongan">
                            <i class="bi bi-share"></i>
                        </button>
                    </div>

                    <hr class="my-5"> 
                    
                    {{-- BAGIAN PERSYARATAN --}}
                    <h3 class="section-title">Persyaratan</h3>

                    <div class="requirement-badges-container">
                        <span class="job-requirement-badge">
                            <i class="bi bi-briefcase me-1"></i>
                            @if($job->work_policy == 'kerja_di_kantor')
                                Kerja di Kantor
                            @elseif($job->work_policy == 'remote')
                                Remote
                            @elseif($job->work_policy == 'hybrid')
                                Hybrid
                            @else
                                {{ ucfirst($job->work_policy ?? 'Penuh Waktu') }}
                            @endif
                        </span>
                        <span class="job-requirement-badge">
                            <i class="bi bi-person-badge me-1"></i>
                            {{ ucfirst(str_replace('_', ' ', $job->experience_level ?? 'Fresh Graduate')) }}
                        </span>
                        <span class="job-requirement-badge">
                            <i class="bi bi-mortarboard me-1"></i>
                            Minimal {{ $job->formatted_education ?? 'Tidak Diketahui' }}
                        </span>
                        
                        {{-- Mengambil Persyaratan Kustom dari custom_requirements_list --}}
                        @if(isset($job->custom_requirements_list) && is_array($job->custom_requirements_list))
                            @foreach($job->custom_requirements_list as $req)
                                @if(!empty(trim($req)))
                                    <span class="job-requirement-badge">
                                        <i class="bi bi-check-circle me-1"></i>{{ ucfirst(trim($req)) }}
                                    </span>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    
                    <hr class="my-5">

                    {{-- BAGIAN SKILLS DINAMIS (Data dari Controller) --}}
                    {{-- Menggunakan skills_list yang sudah diolah --}}
                    @if(isset($job->skills_list) && is_array($job->skills_list) && count($job->skills_list) > 0)
                        <div class="skills-section">
                            <h3 class="skills-header">
                                <i class="bi bi-tools skill-badge-icon"></i>Keterampilan yang Dibutuhkan
                            </h3>
                            <div class="skills-badges-container">
                                @foreach($job->skills_list as $skill)
                                    <span class="skill-badge">
                                        <i class="bi bi-code-slash me-1"></i>{{ $skill }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <hr class="my-5">
                    @endif
                    
                    {{-- BAGIAN DESKRIPSI PEKERJAAN --}}
                    <h3 class="section-title">Deskripsi Pekerjaan</h3>
                    <div class="job-description">
                        @if(!empty($job->description))
                            {!! nl2br(e($job->description)) !!}
                        @else
                            <p class="text-muted">Deskripsi pekerjaan belum tersedia.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        function shareJob() { 
            if (navigator.share) {
                navigator.share({
                    title: '{{ $job->title }}',
                    text: 'Lihat lowongan kerja ini: {{ $job->title }} di {{ $job->company }}',
                    url: window.location.href,
                })
                .then(() => console.log('Berhasil dibagikan'))
                .catch((error) => console.log('Error sharing', error));
            } else {
                // Fallback untuk browser yang tidak support Web Share API
                navigator.clipboard.writeText(window.location.href).then(function() {
                    alert('Link lowongan telah disalin ke clipboard!');
                }, function() {
                    alert('Link lowongan: ' + window.location.href);
                });
            }
        }
        
        function saveJob() { 
            // Simulasi save job
            const btn = event.currentTarget;
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-bookmark-check-fill"></i>';
            btn.style.color = '#0d6efd';
            btn.style.borderColor = '#0d6efd';
            
            setTimeout(() => {
                alert('Lowongan berhasil disimpan!');
                // Kembalikan ke state semula setelah beberapa detik
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                    btn.style.color = '';
                    btn.style.borderColor = '';
                }, 2000);
            }, 300);
        }
    </script>
</body>
</html>