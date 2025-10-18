<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        $jobType = $request->get('job_type');
        $type = $request->get('type');

        $jobs = JobListing::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('company', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->when($jobType, function ($query, $jobType) {
                $query->where('job_type', $jobType);
            })
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->latest()
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'job_type' => $jobType,
                'type' => $type,
                'per_page' => $perPage,
            ]);

        return view('admin.job_listings.index', compact('jobs', 'search', 'jobType', 'type', 'perPage'));
    }

    public function create()
    {
        $lokasi = Lokasi::all();
        return view('admin.job_listings.create', compact('lokasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'location' => 'required|string|max:255',
            'salary_min' => 'nullable|integer',
            'salary_max' => 'nullable|integer',
            'type' => 'required|in:full-time,part-time,contract,internship',
            'job_type' => 'required|in:penuh_waktu,kontrak,magang,paruh_waktu,freelance,harian',
            'work_policy' => 'required|in:kerja_di_kantor,hybrid,remote',
            'experience_level' => 'required|in:tidak_berpengalaman,fresh_graduate,kurang_dari_setahun,1_3_tahun,3_5_tahun,5_10_tahun,lebih_dari_10_tahun',
            'education_level' => 'required|in:s3,s2,s1,d1_d4,sma_smk,smp,sd',
            'requirements' => 'nullable|string',
            'skills' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'deadline' => 'nullable|date',
            'is_public' => 'boolean',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('company_logo')) {
            $validated['company_logo'] = $request->file('company_logo')->store('company_logos', 'public');
        }

        JobListing::create($validated);

        return redirect()->route('admin.job_listings.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(JobListing $jobListing)
    {
        $lokasi = Lokasi::all();
        return view('admin.job_listings.edit', compact('jobListing', 'lokasi'));
    }

    public function update(Request $request, JobListing $jobListing)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'location' => 'required|string|max:255',
            'salary_min' => 'nullable|integer',
            'salary_max' => 'nullable|integer',
            'type' => 'required|in:full-time,part-time,contract,internship',
            'job_type' => 'required|in:penuh_waktu,kontrak,magang,paruh_waktu,freelance,harian',
            'work_policy' => 'required|in:kerja_di_kantor,hybrid,remote',
            'experience_level' => 'required|in:tidak_berpengalaman,fresh_graduate,kurang_dari_setahun,1_3_tahun,3_5_tahun,5_10_tahun,lebih_dari_10_tahun',
            'education_level' => 'required|in:s3,s2,s1,d1_d4,sma_smk,smp,sd',
            'requirements' => 'nullable|string',
            'skills' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'deadline' => 'nullable|date',
            'is_public' => 'boolean',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('company_logo')) {
            if ($jobListing->company_logo && Storage::disk('public')->exists($jobListing->company_logo)) {
                Storage::disk('public')->delete($jobListing->company_logo);
            }
            $validated['company_logo'] = $request->file('company_logo')->store('company_logos', 'public');
        }

        $jobListing->update($validated);

        return redirect()->route('admin.job_listings.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(JobListing $jobListing)
    {
        if ($jobListing->company_logo && Storage::disk('public')->exists($jobListing->company_logo)) {
            Storage::disk('public')->delete($jobListing->company_logo);
        }

        $jobListing->delete();

        return redirect()->route('admin.job_listings.index')->with('success', 'Lowongan berhasil dihapus.');
    }
}
