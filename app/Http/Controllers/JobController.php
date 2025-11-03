<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Digunakan untuk mencari nama lokasi
use Carbon\Carbon;
use NumberFormatter;

class JobController extends Controller
{
    /**
     * Menampilkan daftar lowongan pekerjaan publik.
     */
    public function index()
    {
        // Ambil hanya job yang is_public = true, diurutkan terbaru
        $jobs = JobListing::where('is_public', true)
            ->latest()
            ->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Menampilkan detail satu lowongan pekerjaan.
     */
    public function show($id)
    {
        // 1. Ambil data job (akan throw 404 jika tidak ditemukan atau is_public=false)
        $job = JobListing::where('is_public', true)->findOrFail($id);

        // --- START: PENGOLAHAN DATA UNTUK VIEW ---

        // 2. Tambahkan properti formatted_salary
        $job->formatted_salary = $this->formatSalary($job->salary_min ?? null, $job->salary_max ?? null);

        // 3. Gabungkan dan olah Skills & Custom Requirements
        $allSkills = [];
        $rawSkills = trim($job->skills ?? '');
        $rawRequirements = trim($job->requirements ?? '');

        // Olah skills dari kolom 'skills'
        if (!empty($rawSkills)) {
            $skillsArray = str_contains($rawSkills, ',') ? explode(',', $rawSkills) : explode(' ', $rawSkills);
            $allSkills = array_merge($allSkills, array_map('trim', array_filter($skillsArray)));
        }
        $job->skills_list = array_unique(array_filter($allSkills));
        
        // Olah requirements dari kolom 'requirements' untuk badges kustom
        $job->custom_requirements_list = [];
        if (!empty($rawRequirements)) {
            $reqsArray = str_contains($rawRequirements, ',') ? explode(',', $rawRequirements) : explode(' ', $rawRequirements);
            $job->custom_requirements_list = array_map('trim', array_filter($reqsArray));
        }
        
        // 4. Pengolahan Lokasi: Ambil NAMA LOKASI dari ID
        $job->location_string = $this->getLocationString($job);

        // 5. Pastikan created_at dan updated_at adalah objek Carbon
        if (!($job->created_at instanceof Carbon)) {
            $job->created_at = Carbon::parse($job->created_at);
        }
        if (!($job->updated_at instanceof Carbon)) {
            $job->updated_at = Carbon::parse($job->updated_at);
        }
        
        // 6. Format Education Level
        $job->formatted_education = $this->formatEducationLevel($job->education_level ?? 'Tidak Diketahui');

        // --- END: PENGOLAHAN DATA UNTUK VIEW ---

        return view('jobs.show', compact('job'));
    }
    
    /**
     * Menangani proses aplikasi/lamaran.
     */
    public function apply($id)
    {
        return redirect()->back()->with('success', 'Halaman lamar kerja akan segera tersedia!');
    }

    // --- FUNGSI HELPER ---

    /**
     * Helper untuk memformat gaji ke format mata uang (IDR).
     */
    private function formatSalary($min, $max)
    {
        if (empty($min) && empty($max)) {
            return 'Gaji Tidak Ditampilkan';
        }

        // Fallback jika ekstensi intl (NumberFormatter) tidak tersedia
        if (!class_exists('NumberFormatter')) {
            $min = (int) $min;
            $max = (int) $max;
            if ($min > 0 && $max > 0 && $min !== $max) {
                 // Fallback hanya menggunakan titik sebagai pemisah ribuan
                 return "Rp " . number_format($min, 0, ',', '.') . " - Rp " . number_format($max, 0, ',', '.');
            }
            return 'Gaji Negosiasi';
        }
        
        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
        $min = (int) $min;
        $max = (int) $max;

        if ($min > 0 && $max > 0 && $min !== $max) {
            $formatted_min = $formatter->formatCurrency($min, 'IDR');
            $formatted_max = $formatter->formatCurrency($max, 'IDR');
            
            // PENTING: Membersihkan string hasil format dari 'Rp', spasi, dan KOMA NOL NOL (',00')
            $clean_min = trim(str_replace(['Rp', ' ', ',00'], '', $formatted_min));
            $clean_max = trim(str_replace(['Rp', ' ', ',00'], '', $formatted_max));
            
            return "Rp " . $clean_min . " - Rp " . $clean_max;
        } 
        
        if ($min > 0) {
            $formatted_min = $formatter->formatCurrency($min, 'IDR');
            // PENTING: Membersihkan string hasil format dari ',00'
            $clean_min = trim(str_replace([',00'], '', $formatted_min));
            return $clean_min . ' (Minimal)';
        }

        return 'Gaji Negosiasi';
    }

    /**
     * Helper untuk mengambil NAMA lokasi berdasarkan ID dari database.
     * PENTING: Sesuaikan nama tabel (villages, districts, regencies, provinces)
     * dengan skema database Anda.
     */
    private function getLocationString($job)
    {
        $parts = [];
        
        // Ambil nama Desa/Kelurahan
        if ($job->desa_id) {
            $village = DB::table('villages')->where('id', $job->desa_id)->value('name');
            if ($village) $parts[] = $village;
        }

        // Ambil nama Kecamatan
        if ($job->kecamatan_id) {
            $district = DB::table('districts')->where('id', $job->kecamatan_id)->value('name');
            if ($district) $parts[] = $district;
        }

        // Ambil nama Kabupaten/Kota
        if ($job->kabupaten_id) {
            $regency = DB::table('regencies')->where('id', $job->kabupaten_id)->value('name');
            // Cek apakah Kabupaten/Kota
            $is_city = str_starts_with(strtoupper($regency ?? ''), 'KOTA ');
            $regency_name = $regency;
            if ($regency) $parts[] = $regency_name;
        }

        // Ambil nama Provinsi
        if ($job->provinsi_id) {
            $province = DB::table('provinces')->where('id', $job->provinsi_id)->value('name');
            if ($province) $parts[] = $province;
        }
        
        // Gabungkan komponen, dari spesifik ke umum (Desa, Kec, Kab/Kota, Prov)
        $locationString = implode(', ', array_filter($parts));
        
        return $locationString ?: 'Lokasi Tidak Diketahui';
    }
    
    /**
     * Helper untuk memformat tingkat pendidikan.
     */
    private function formatEducationLevel(string $level)
    {
        $map = [
            'sma_smk' => 'SMA/SMK',
            's1' => 'S1',
            's2' => 'S2',
            's3' => 'S3',
            'sd' => 'SD',
            'smp' => 'SMP',
            'diploma' => 'D3/D4'
        ];
        
        return $map[strtolower($level)] ?? strtoupper(str_replace('_', ' ', $level));
    }
}