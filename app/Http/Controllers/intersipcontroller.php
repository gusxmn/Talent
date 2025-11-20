<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;

class intersipController extends Controller
{
    /**
     * Tampilkan daftar lowongan magang ke publik
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $provinsi = $request->input('provinsi');
        $kabupaten = $request->input('kabupaten');

        $magang = Magang::with(['province', 'regency'])
            ->where('status', true) // hanya tampilkan magang aktif
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%$search%")
                      ->orWhere('perusahaan', 'like', "%$search%")
                      ->orWhere('posisi', 'like', "%$search%");
                });
            })
            ->when($provinsi, function ($query) use ($provinsi) {
                $query->where('provinsi_id', $provinsi);
            })
            ->when($kabupaten, function ($query) use ($kabupaten) {
                $query->where('kabupaten_id', $kabupaten);
            })
            ->latest()
            ->paginate(9);

        $provinces = Province::all();

        return view('magang.index', compact('magang', 'provinces', 'search', 'provinsi', 'kabupaten'));
    }

    /**
     * Tampilkan detail satu lowongan magang
     */
    public function show($id)
    {
        $magang = Magang::with(['province', 'regency', 'district', 'village'])
            ->where('status', true)
            ->findOrFail($id);

        return view('magang.show', compact('magang'));
    }

    /**
     * API Lokasi Dinamis (untuk dropdown AJAX publik)
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
