<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use NumberFormatter;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobListing::where('is_public', true)
            ->latest()
            ->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    public function show($id)
    {
        // Ambil job utama
        $job = JobListing::where('is_public', true)->findOrFail($id);

        // ============================
        // PROSES DATA JOB UTAMA
        // ============================
        $job->formatted_salary = $this->formatSalary($job->salary_min, $job->salary_max);
        $job->skills_list = $this->explodeValues($job->skills);
        $job->custom_requirements_list = $this->explodeValues($job->requirements);
        $job->location_string = $this->getLocationString($job);
        $job->formatted_education = $this->formatEducationLevel($job->education_level ?? 'Tidak Diketahui');

        // Fix Carbon
        $job->created_at = Carbon::parse($job->created_at);
        $job->updated_at = Carbon::parse($job->updated_at);

        // ============================
        // 🔥 AMBIL LOWONGAN LAIN
        // ============================
        $relatedJobs = JobListing::where('is_public', true)
            ->where('id', '!=', $job->id)
            ->inRandomOrder()
            ->limit(6)
            ->get();

        // ============================
        // 🔥 PROSES DATA RELATED JOBS
        // ============================
        foreach ($relatedJobs as $r) {
            $r->formatted_salary = $this->formatSalary($r->salary_min, $r->salary_max);
            $r->skills_list = $this->explodeValues($r->skills);
            $r->custom_requirements_list = $this->explodeValues($r->requirements);
            $r->location_string = $this->getLocationString($r);
            $r->formatted_education = $this->formatEducationLevel($r->education_level ?? 'Tidak Diketahui');
        }

        return view('jobs.show', compact('job', 'relatedJobs'));
    }

    public function apply($id)
    {
        return redirect()->back()->with('success', 'Halaman lamar kerja akan segera tersedia!');
    }

    // ============================================================
    // HELPER FUNCTIONS
    // ============================================================

    private function explodeValues($value)
    {
        if (empty(trim($value))) {
            return [];
        }

        $parts = str_contains($value, ',')
            ? explode(',', $value)
            : explode(' ', $value);

        return array_map(fn($v) => trim($v), array_filter($parts));
    }

    private function formatSalary($min, $max)
    {
        if (empty($min) && empty($max)) {
            return 'Gaji Tidak Ditampilkan';
        }

        if (!class_exists('NumberFormatter')) {
            $min = (int) $min;
            $max = (int) $max;

            if ($min > 0 && $max > 0 && $min !== $max) {
                return "Rp " . number_format($min, 0, ',', '.') .
                       " - Rp " . number_format($max, 0, ',', '.');
            }
            return 'Gaji Negosiasi';
        }

        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
        $min = (int) $min;
        $max = (int) $max;

        if ($min > 0 && $max > 0 && $min !== $max) {
            $formatted_min = $formatter->formatCurrency($min, 'IDR');
            $formatted_max = $formatter->formatCurrency($max, 'IDR');

            $clean_min = trim(str_replace(['Rp', ' ', ',00'], '', $formatted_min));
            $clean_max = trim(str_replace(['Rp', ' ', ',00'], '', $formatted_max));

            return "Rp $clean_min - Rp $clean_max";
        }

        if ($min > 0) {
            $formatted_min = $formatter->formatCurrency($min, 'IDR');
            $clean_min = trim(str_replace([',00'], '', $formatted_min));
            return $clean_min . ' (Minimal)';
        }

        return 'Gaji Negosiasi';
    }

    private function getLocationString($job)
    {
        $parts = [];

        if ($job->desa_id) {
            $village = DB::table('villages')->where('id', $job->desa_id)->value('name');
            if ($village) $parts[] = $village;
        }

        if ($job->kecamatan_id) {
            $district = DB::table('districts')->where('id', $job->kecamatan_id)->value('name');
            if ($district) $parts[] = $district;
        }

        if ($job->kabupaten_id) {
            $regency = DB::table('regencies')->where('id', $job->kabupaten_id)->value('name');
            if ($regency) $parts[] = $regency;
        }

        if ($job->provinsi_id) {
            $province = DB::table('provinces')->where('id', $job->provinsi_id)->value('name');
            if ($province) $parts[] = $province;
        }

        return implode(', ', $parts) ?: 'Lokasi Tidak Diketahui';
    }

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
