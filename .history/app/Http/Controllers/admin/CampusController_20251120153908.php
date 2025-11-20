<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class CampusController extends Controller
{
    /**
     * Display a listing of the campuses.
     */
    public function index(): View
    {
        $campuses = Campus::withCount('students')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.campuses.index', compact('campuses'));
    }

    /**
     * Show the form for creating a new campus.
     */
    public function create(): View
    {
        return view('admin.campuses.create');
    }

    /**
     * Store a newly created campus in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:campuses,name',
            'code' => 'required|string|max:10|unique:campuses,code',
            'address' => 'required|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        Campus::create($validated);

        return redirect()
            ->route('admin.campuses.index')
            ->with('success', 'Campus berhasil dibuat.');
    }

    /**
     * Display the specified campus.
     */
    public function show($id): View
    {
        $campus = Campus::with(['students' => function($query) {
            $query->orderBy('name');
        }])
        ->withCount('students')
        ->findOrFail($id);

        return view('admin.campuses.show', compact('campus'));
    }

    public function destroy(Campus $campus)
    {
        // Delete logo file if exists
        if ($campus->logo_path && Storage::disk('public')->exists($campus->logo_path)) {
            Storage::disk('public')->delete($campus->logo_path);
        }

        $campus->delete();

        return redirect()->route('admin.campus.index')
            ->with('success', 'Kampus berhasil dihapus');
    }
}