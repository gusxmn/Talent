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
    public function index()
    {
        $campuses = Campus::latest()->paginate(10); // Ganti get() dengan paginate()
        return view('admin.campus.index', compact('campuses'));
    }

    public function show(Campus $campus)
    {
        return view('admin.campus.show', compact('campus'));
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