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

    /**
     * Show the form for editing the specified campus.
     */
    public function edit($id): View
    {
        $campus = Campus::findOrFail($id);

        return view('admin.campuses.edit', compact('campus'));
    }

    /**
     * Update the specified campus in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $campus = Campus::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:campuses,name,' . $campus->id,
            'code' => 'required|string|max:10|unique:campuses,code,' . $campus->id,
            'address' => 'required|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        $campus->update($validated);

        return redirect()
            ->route('admin.campuses.index')
            ->with('success', 'Campus berhasil diperbarui.');
    }

    /**
     * Remove the specified campus from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $campus = Campus::findOrFail($id);

        // Cek apakah campus memiliki students
        if ($campus->students()->exists()) {
            return redirect()
                ->route('admin.campuses.index')
                ->with('error', 'Tidak dapat menghapus campus yang masih memiliki students.');
        }

        $campus->delete();

        return redirect()
            ->route('admin.campuses.index')
            ->with('success', 'Campus berhasil dihapus.');
    }

    /**
     * Export campuses to Excel.
     */
    public function exportExcel()
    {
        // Sementara comment dulu karena package Excel belum diinstall
        // $timestamp = now()->format('Y-m-d_H-i-s');
        // $filename = "campuses_export_{$timestamp}.xlsx";
        // return Excel::download(new CampusesExport, $filename);

        return redirect()
            ->route('admin.campuses.index')
            ->with('info', 'Fitur export Excel akan segera tersedia.');
    }

    /**
     * Get students by campus ID.
     */
    public function getStudents($id): JsonResponse
    {
        try {
            $campus = Campus::findOrFail($id);
            
            $students = $campus->students()
                ->select('id', 'name', 'email', 'phone', 'created_at')
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'campus' => [
                    'id' => $campus->id,
                    'name' => $campus->name
                ],
                'students' => $students,
                'total_students' => $students->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Campus tidak ditemukan.'
            ], 404);
        }
    }

    /**
     * Get campuses for select dropdown (AJAX).
     */
    public function getCampusesForSelect(): JsonResponse
    {
        $campuses = Campus::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'code']);

        return response()->json([
            'success' => true,
            'campuses' => $campuses
        ]);
    }
}