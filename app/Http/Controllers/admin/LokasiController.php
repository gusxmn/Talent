<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Menampilkan semua data lokasi dengan pencarian & pagination
     */
    public function index(Request $request)
    {
        $query = Lokasi::query();

        // Fitur pencarian
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('negara', 'like', "%{$q}%")
                    ->orWhere('provinsi', 'like', "%{$q}%")
                    ->orWhere('kabupaten', 'like', "%{$q}%")
                    ->orWhere('kecamatan', 'like', "%{$q}%")
                    ->orWhere('kelurahan', 'like', "%{$q}%")
                    ->orWhere('desa', 'like', "%{$q}%")
                    ->orWhere('kode_pos', 'like', "%{$q}%");
            });
        }

        // Jumlah data per halaman (default 10)
        $perPage = $request->get('perPage', 10);

        $lokasi = $query->orderBy('provinsi')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.lokasi.index', compact('lokasi'));
    }

    /**
     * Menampilkan form tambah lokasi
     */
    public function create()
    {
        return view('admin.lokasi.create');
    }

    /**
     * Simpan data lokasi baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'negara'    => 'required|string|max:100',
            'provinsi'  => 'required|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',
            'desa'      => 'nullable|string|max:100',
            'kode_pos'  => 'nullable|string|max:10',
        ]);

        Lokasi::create($validated);

        return redirect()->route('admin.lokasi.index')
            ->with('success', 'Data lokasi berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail lokasi tertentu
     */
    public function show(Lokasi $lokasi)
    {
        return view('admin.lokasi.show', compact('lokasi'));
    }

    /**
     * Menampilkan form edit lokasi
     */
    public function edit(Lokasi $lokasi)
    {
        return view('admin.lokasi.edit', compact('lokasi'));
    }

    /**
     * Update data lokasi
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        $validated = $request->validate([
            'negara'    => 'required|string|max:100',
            'provinsi'  => 'required|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',
            'desa'      => 'nullable|string|max:100',
            'kode_pos'  => 'nullable|string|max:10',
        ]);

        $lokasi->update($validated);

        return redirect()->route('admin.lokasi.index')
            ->with('success', 'Data lokasi berhasil diperbarui!');
    }

    /**
     * Hapus data lokasi
     */
    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();

        return redirect()->route('admin.lokasi.index')
            ->with('success', 'Data lokasi berhasil dihapus!');
    }
}
