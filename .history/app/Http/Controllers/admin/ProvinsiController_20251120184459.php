<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query dari database
        $query = Provinsi::query();

        // Filter data berdasarkan pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('id', 'like', "%$search%");
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $provinsis = $query->paginate($perPage);

        return view('admin.reference.provinsi.index', [
            'title' => 'Manajemen Provinsi',
            'provinsis' => $provinsis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reference.provinsi.create', [
            'title' => 'Tambah Provinsi'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required|string|max:100|unique:provinces,name',
        ]);

        // Simpan data
        Provinsi::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.reference.provinsi.index')
            ->with('success', 'Provinsi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $provinsi = Provinsi::findOrFail($id);

        return view('admin.reference.provinsi.show', [
            'title' => 'Detail Provinsi',
            'provinsi' => $provinsi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $provinsi = Provinsi::findOrFail($id);

        return view('admin.reference.provinsi.edit', [
            'title' => 'Edit Provinsi',
            'provinsi' => $provinsi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi
        $request->validate([
            'name' => 'required|string|max:100|unique:provinces,name,' . $id,
        ]);

        // Update data
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.reference.provinsi.index')
            ->with('success', 'Provinsi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->delete();

        return redirect()->route('admin.reference.provinsi.index')
            ->with('success', 'Provinsi berhasil dihapus');
    }
}
