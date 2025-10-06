@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Lowongan</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-light border text-dark alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.job_listings.update', $jobListing->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Posisi & Perusahaan --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="title" class="form-label">Posisi</label>
                <input type="text" name="title" id="title"
                       class="form-control"
                       value="{{ old('title', $jobListing->title) }}" required>
            </div>
            <div class="col-md-6">
                <label for="company" class="form-label">Perusahaan</label>
                <input type="text" name="company" id="company"
                       class="form-control"
                       value="{{ old('company', $jobListing->company) }}" required>
            </div>
        </div>

        {{-- Lokasi --}}
        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" name="location" id="location"
                   class="form-control"
                   value="{{ old('location', $jobListing->location) }}" required>
        </div>

        {{-- Gaji --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="salary_min" class="form-label">Gaji Minimum</label>
                <input type="number" name="salary_min" id="salary_min"
                       class="form-control"
                       value="{{ old('salary_min', $jobListing->salary_min) }}">
            </div>
            <div class="col-md-6">
                <label for="salary_max" class="form-label">Gaji Maksimum</label>
                <input type="number" name="salary_max" id="salary_max"
                       class="form-control"
                       value="{{ old('salary_max', $jobListing->salary_max) }}">
            </div>
        </div>

        {{-- Jenis & Kebijakan Kerja --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="job_type" class="form-label">Jenis Pekerjaan</label>
                <select name="job_type" id="job_type" class="form-select" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="full-time" {{ old('job_type', $jobListing->job_type) == 'full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="part-time" {{ old('job_type', $jobListing->job_type) == 'part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="contract" {{ old('job_type', $jobListing->job_type) == 'contract' ? 'selected' : '' }}>Contract</option>
                    <option value="internship" {{ old('job_type', $jobListing->job_type) == 'internship' ? 'selected' : '' }}>Internship</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="work_policy" class="form-label">Kebijakan Kerja</label>
                <select name="work_policy" id="work_policy" class="form-select" required>
                    <option value="">-- Pilih Kebijakan --</option>
                    <option value="onsite" {{ old('work_policy', $jobListing->work_policy) == 'onsite' ? 'selected' : '' }}>Onsite</option>
                    <option value="hybrid" {{ old('work_policy', $jobListing->work_policy) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    <option value="remote" {{ old('work_policy', $jobListing->work_policy) == 'remote' ? 'selected' : '' }}>Remote</option>
                </select>
            </div>
        </div>

        {{-- Level Pengalaman & Pendidikan --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="experience_level" class="form-label">Level Pengalaman</label>
                <select name="experience_level" id="experience_level" class="form-select" required>
                    <option value="">-- Pilih Level --</option>
                    <option value="entry" {{ old('experience_level', $jobListing->experience_level) == 'entry' ? 'selected' : '' }}>Entry Level</option>
                    <option value="mid" {{ old('experience_level', $jobListing->experience_level) == 'mid' ? 'selected' : '' }}>Mid Level</option>
                    <option value="senior" {{ old('experience_level', $jobListing->experience_level) == 'senior' ? 'selected' : '' }}>Senior Level</option>
                    <option value="manager" {{ old('experience_level', $jobListing->experience_level) == 'manager' ? 'selected' : '' }}>Manager</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="education_level" class="form-label">Pendidikan Minimal</label>
                <select name="education_level" id="education_level" class="form-select" required>
                    <option value="">-- Pilih Pendidikan --</option>
                    <option value="sma" {{ old('education_level', $jobListing->education_level) == 'sma' ? 'selected' : '' }}>SMA / SMK</option>
                    <option value="d3" {{ old('education_level', $jobListing->education_level) == 'd3' ? 'selected' : '' }}>D3</option>
                    <option value="s1" {{ old('education_level', $jobListing->education_level) == 's1' ? 'selected' : '' }}>S1</option>
                    <option value="s2" {{ old('education_level', $jobListing->education_level) == 's2' ? 'selected' : '' }}>S2</option>
                </select>
            </div>
        </div>

        {{-- Requirements --}}
        <div class="mb-3">
            <label for="requirements" class="form-label">Persyaratan Umum</label>
            <textarea name="requirements" id="requirements" rows="3" class="form-control">{{ old('requirements', $jobListing->requirements) }}</textarea>
        </div>

        {{-- Skills --}}
        <div class="mb-3">
            <label for="skills" class="form-label">Keahlian (Skill)</label>
            <textarea name="skills" id="skills" rows="3" class="form-control">{{ old('skills', $jobListing->skills) }}</textarea>
        </div>

        {{-- Qualifications --}}
        <div class="mb-3">
            <label for="qualifications" class="form-label">Kualifikasi Tambahan</label>
            <textarea name="qualifications" id="qualifications" rows="3" class="form-control">{{ old('qualifications', $jobListing->qualifications) }}</textarea>
        </div>

        {{-- Deadline --}}
        <div class="mb-3">
            <label for="deadline" class="form-label">Deadline</label>
            <input type="date" name="deadline" id="deadline" class="form-control"
                   value="{{ old('deadline', $jobListing->deadline ? \Carbon\Carbon::parse($jobListing->deadline)->format('Y-m-d') : '') }}">
        </div>

        {{-- Logo --}}
        <div class="mb-3">
            <label for="company_logo" class="form-label">Logo Perusahaan</label>
            <input type="file" name="company_logo" id="company_logo" class="form-control">
            @if($jobListing->company_logo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $jobListing->company_logo) }}" class="img-thumbnail border" style="max-width:120px;">
                </div>
            @endif
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Pekerjaan</label>
            <textarea name="description" id="description" rows="5" class="form-control" required>{{ old('description', $jobListing->description) }}</textarea>
        </div>

        {{-- Publikasi --}}
        <div class="form-check mb-4">
            <input type="checkbox" name="is_public" id="is_public" class="form-check-input"
                   value="1" {{ old('is_public', $jobListing->is_public) ? 'checked' : '' }}>
            <label for="is_public" class="form-check-label">Tampilkan ke Publik</label>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.job_listings.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
