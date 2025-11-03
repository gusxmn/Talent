<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MagangController extends Controller
{
    /**
     * Tampilkan daftar magang
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $magang = Magang::with(['province', 'regency', 'district', 'village'])
            ->when($search, function ($query) use ($search) {
                $query->where('judul', 'like', "%$search%")
                      ->orWhere('perusahaan', 'like', "%$search%")
                      ->orWhere('posisi', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.magang.index', compact('magang', 'search'));
    }

    /**
     * Tampilkan form tambah magang
     */
    public function create()
    {
        $provinces = Province::all();
        return view('admin.magang.create', compact('provinces'));
    }

    /**
     * Simpan data magang baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'durasi' => 'required|string|max:100',
            'posisi' => 'required|string|max:100',
            'kuota' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'logo_perusahaan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'provinsi_id' => 'nullable|integer',
            'kabupaten_id' => 'nullable|integer',
            'kecamatan_id' => 'nullable|integer',
            'desa_id' => 'nullable|integer',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo_perusahaan')) {
            $data['logo_perusahaan'] = $request->file('logo_perusahaan')->store('logos', 'public');
        }

        $data['status'] = $request->input('status', true);

        Magang::create($data);

        return redirect()->route('admin.magang.index')->with('success', 'Lowongan magang berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit
     */
    public function edit($id)
    {
        $magang = Magang::findOrFail($id);
        $provinces = Province::all();

        $regencies = $magang->provinsi_id ? Regency::where('province_id', $magang->provinsi_id)->get() : collect();
        $districts = $magang->kabupaten_id ? District::where('regency_id', $magang->kabupaten_id)->get() : collect();
        $villages = $magang->kecamatan_id ? Village::where('district_id', $magang->kecamatan_id)->get() : collect();

        return view('admin.magang.edit', compact('magang', 'provinces', 'regencies', 'districts', 'villages'));
    }

    /**
     * Update data magang
     */
    public function update(Request $request, $id)
    {
        $magang = Magang::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'durasi' => 'required|string|max:100',
            'posisi' => 'required|string|max:100',
            'kuota' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'logo_perusahaan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo_perusahaan')) {
            if ($magang->logo_perusahaan && Storage::disk('public')->exists($magang->logo_perusahaan)) {
                Storage::disk('public')->delete($magang->logo_perusahaan);
            }
            $data['logo_perusahaan'] = $request->file('logo_perusahaan')->store('logos', 'public');
        }

        $data['status'] = $request->input('status', false);

        $magang->update($data);

        return redirect()->route('admin.magang.index')->with('success', 'Lowongan magang berhasil diperbarui.');
    }

    /**
     * Hapus data magang
     */
    public function destroy($id)
    {
        $magang = Magang::findOrFail($id);

        if ($magang->logo_perusahaan && Storage::disk('public')->exists($magang->logo_perusahaan)) {
            Storage::disk('public')->delete($magang->logo_perusahaan);
        }

        $magang->delete();

        return redirect()->route('admin.magang.index')->with('success', 'Lowongan magang berhasil dihapus.');
    }

    /**
     * API Lokasi Dinamis (untuk AJAX)
     */
    public function getRegencies($province_id)
    {
        return response()->json(Regency::where('province_id', $province_id)->get());
    }

    public function getDistricts($regency_id)
    {
        return response()->json(District::where('regency_id', $regency_id)->get());
    }

    public function getVillages($district_id)
    {
        return response()->json(Village::where('district_id', $district_id)->get());
    }
}
