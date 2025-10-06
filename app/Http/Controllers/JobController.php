<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        // Ambil hanya job yang is_public = true
        $jobs = JobListing::where('is_public', true)
                    ->latest()
                    ->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    public function show($id)
    {
        $job = JobListing::where('is_public', true)->findOrFail($id);
        return view('jobs.show', compact('job'));
    }
}
