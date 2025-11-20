<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $perPage = request('per_page', 10);
        $provinsiId = request('provinsi_id');

        $kabupatens = Kabupaten::with('provinsi')
            ->when($search, function($query) use ($search) {
                $query->where('nama_kabupaten', 'like', "%{$search}%")
                      ->orWhere('kode_kabupaten', 'like', "%{$search}%");
            })
            ->when($provinsiId, function($query) use ($provinsiId) {
                $query->where('provinsi_id', $provinsiId);
            })
            ->orderBy('nama_kabupaten')
            ->paginate($perPage);

        $provinsis = Provinsi::where('status', true)->orderBy('nama_provinsi')->get();

        return view('admin.reference.kabupaten.index', compact('kabupatens', 'provinsis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinsis = Provinsi::where('status', true)->orderBy('nama_provinsi')->get();
        return view('admin.reference.kabupaten.create', compact('provinsis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'provinsi_id' => 'required|exists:provinsis,id',
            'kode_kabupaten' => 'required|string|max:10|unique:kabupatens,kode_kabupaten',
            'nama_kabupaten' => 'required|string|max:100',
            'jenis' => 'required|in:Kabupaten,Kota',
            'deskripsi' => 'nullable|string|max:500',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            Kabupaten::create([
                'provinsi_id' => $request->provinsi_id,
                'kode_kabupaten' => $request->kode_kabupaten,
                'nama_kabupaten' => $request->nama_kabupaten,
                'jenis' => $request->jenis,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.reference.kabupaten.index')
                ->with('success', 'Kabupaten/Kota berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kabupaten = Kabupaten::findOrFail($id);
        $provinsis = Provinsi::where('status', true)->orderBy('nama_provinsi')->get();
        
        return view('admin.reference.kabupaten.edit', compact('kabupaten', 'provinsis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kabupaten = Kabupaten::findOrFail($id);

        $request->validate([
            'provinsi_id' => 'required|exists:provinsis,id',
            'kode_kabupaten' => 'required|string|max:10|unique:kabupatens,kode_kabupaten,' . $id,
            'nama_kabupaten' => 'required|string|max:100',
            'jenis' => 'required|in:Kabupaten,Kota',
            'deskripsi' => 'nullable|string|max:500',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            $kabupaten->update([
                'provinsi_id' => $request->provinsi_id,
                'kode_kabupaten' => $request->kode_kabupaten,
                'nama_kabupaten' => $request->nama_kabupaten,
                'jenis' => $request->jenis,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.reference.kabupaten.index')
                ->with('success', 'Kabupaten/Kota berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kabupaten = Kabupaten::findOrFail($id);

        try {
            DB::beginTransaction();

            // Cek apakah kabupaten memiliki kecamatan
            if ($kabupaten->kecamatans()->exists()) {
                return redirect()->back()
                    ->with('error', 'Tidak dapat menghapus kabupaten karena masih memiliki data kecamatan.');
            }

            $kabupaten->delete();

            DB::commit();

            return redirect()->route('admin.reference.kabupaten.index')
                ->with('success', 'Kabupaten/Kota berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Get kabupaten by provinsi for API
     */
    public function getKabupaten()
    {
        try {
            $kabupatens = Kabupaten::with('provinsi')
                ->where('status', true)
                ->orderBy('nama_kabupaten')
                ->get(['id', 'kode_kabupaten', 'nama_kabupaten', 'jenis', 'provinsi_id']);

            return response()->json([
                'success' => true,
                'data' => $kabupatens
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kabupaten: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get kabupaten by provinsi for API
     */
    public function getByProvinsi($provinsiId)
    {
        try {
            $kabupatens = Kabupaten::where('provinsi_id', $provinsiId)
                ->where('status', true)
                ->orderBy('nama_kabupaten')
                ->get(['id', 'kode_kabupaten', 'nama_kabupaten', 'jenis']);

            return response()->json([
                'success' => true,
                'data' => $kabupatens
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kabupaten: ' . $e->getMessage()
            ], 500);
        }
    }
}