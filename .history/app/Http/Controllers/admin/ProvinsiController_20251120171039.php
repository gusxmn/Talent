<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query dari database
        $query = Province::query();

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
                'nama_provinsi' => 'DI YOGYAKARTA',
                'nama_pengisi' => 'Admin DIY'
            ],
            [
                'id' => 15,
                'kode_provinsi' => '35',
                'nama_provinsi' => 'JAWA TIMUR',
                'nama_pengisi' => 'Admin Jatim'
            ],
            [
                'id' => 16,
                'kode_provinsi' => '36',
                'nama_provinsi' => 'BANTEN',
                'nama_pengisi' => 'Admin Banten'
            ],
            [
                'id' => 17,
                'kode_provinsi' => '51',
                'nama_provinsi' => 'BALI',
                'nama_pengisi' => 'Admin Bali'
            ],
            [
                'id' => 18,
                'kode_provinsi' => '52',
                'nama_provinsi' => 'NUSA TENGGARA BARAT',
                'nama_pengisi' => 'Admin NTB'
            ],
            [
                'id' => 19,
                'kode_provinsi' => '53',
                'nama_provinsi' => 'NUSA TENGGARA TIMUR',
                'nama_pengisi' => 'Admin NTT'
            ],
            [
                'id' => 20,
                'kode_provinsi' => '61',
                'nama_provinsi' => 'KALIMANTAN BARAT',
                'nama_pengisi' => 'Admin Kalbar'
            ],
            [
                'id' => 21,
                'kode_provinsi' => '62',
                'nama_provinsi' => 'KALIMANTAN TENGAH',
                'nama_pengisi' => 'Admin Kalteng'
            ],
            [
                'id' => 22,
                'kode_provinsi' => '63',
                'nama_provinsi' => 'KALIMANTAN SELATAN',
                'nama_pengisi' => 'Admin Kalsel'
            ],
            [
                'id' => 23,
                'kode_provinsi' => '64',
                'nama_provinsi' => 'KALIMANTAN TIMUR',
                'nama_pengisi' => 'Admin Kaltim'
            ],
            [
                'id' => 24,
                'kode_provinsi' => '65',
                'nama_provinsi' => 'KALIMANTAN UTARA',
                'nama_pengisi' => 'Admin Kalut'
            ],
            [
                'id' => 25,
                'kode_provinsi' => '71',
                'nama_provinsi' => 'SULAWESI UTARA',
                'nama_pengisi' => 'Admin Sulut'
            ],
            [
                'id' => 26,
                'kode_provinsi' => '72',
                'nama_provinsi' => 'SULAWESI TENGAH',
                'nama_pengisi' => 'Admin Sulteng'
            ],
            [
                'id' => 27,
                'kode_provinsi' => '73',
                'nama_provinsi' => 'SULAWESI SELATAN',
                'nama_pengisi' => 'Admin Sulsel'
            ],
            [
                'id' => 28,
                'kode_provinsi' => '74',
                'nama_provinsi' => 'SULAWESI TENGGARA',
                'nama_pengisi' => 'Admin Sultra'
            ],
            [
                'id' => 29,
                'kode_provinsi' => '75',
                'nama_provinsi' => 'GORONTALO',
                'nama_pengisi' => 'Admin Gorontalo'
            ],
            [
                'id' => 30,
                'kode_provinsi' => '76',
                'nama_provinsi' => 'SULAWESI BARAT',
                'nama_pengisi' => 'Admin Sulbar'
            ],
            [
                'id' => 31,
                'kode_provinsi' => '81',
                'nama_provinsi' => 'MALUKU',
                'nama_pengisi' => 'Admin Maluku'
            ],
            [
                'id' => 32,
                'kode_provinsi' => '82',
                'nama_provinsi' => 'MALUKU UTARA',
                'nama_pengisi' => 'Admin Malut'
            ],
            [
                'id' => 33,
                'kode_provinsi' => '91',
                'nama_provinsi' => 'PAPUA BARAT',
                'nama_pengisi' => 'Admin Papua Barat'
            ],
            [
                'id' => 34,
                'kode_provinsi' => '92',
                'nama_provinsi' => 'PAPUA',
                'nama_pengisi' => 'Admin Papua'
            ]
        ]);

        // Filter data berdasarkan pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $provinsisData = $provinsisData->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['kode_provinsi']), $search) ||
                       str_contains(strtolower($item['nama_provinsi']), $search) ||
                       str_contains(strtolower($item['nama_pengisi']), $search);
            });
        }

        // Konversi ke object
        $provinsisData = $provinsisData->map(function ($item) {
            return (object) $item;
        });

        // Pagination manual
        $perPage = $request->get('per_page', 10);
        $currentPage = $request->get('page', 1);
        $currentPageItems = $provinsisData->slice(($currentPage - 1) * $perPage, $perPage)->values();
        
        $provinsis = new LengthAwarePaginator(
            $currentPageItems,
            $provinsisData->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query()
            ]
        );

        return view('admin.reference.provinsi.index', [
            'title' => 'Manajemen Provinsi',
            'provinsis' => $provinsis // Sekarang Paginator, bisa pakai hasPages()
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
            'kode_provinsi' => 'required|string|max:10|unique:provinsis,kode_provinsi',
            'nama_provinsi' => 'required|string|max:100',
            'nama_pengisi' => 'required|string|max:100'
        ]);

        // Simpan data (sementara redirect saja)
        return redirect()->route('admin.reference.provinsi.index')
            ->with('success', 'Provinsi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Data dummy untuk show
        $provinsi = (object)[
            'id' => $id,
            'kode_provinsi' => '11',
            'nama_provinsi' => 'ACEH',
            'nama_pengisi' => 'Admin Aceh'
        ];

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
        // Data dummy untuk edit
        $provinsi = (object)[
            'id' => $id,
            'kode_provinsi' => '11',
            'nama_provinsi' => 'ACEH',
            'nama_pengisi' => 'Admin Aceh'
        ];

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
            'kode_provinsi' => 'required|string|max:10|unique:provinsis,kode_provinsi,' . $id,
            'nama_provinsi' => 'required|string|max:100',
            'nama_pengisi' => 'required|string|max:100'
        ]);

        // Update data (sementara redirect saja)
        return redirect()->route('admin.reference.provinsi.index')
            ->with('success', 'Provinsi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data (sementara redirect saja)
        return redirect()->route('admin.reference.provinsi.index')
            ->with('success', 'Provinsi berhasil dihapus');
    }
}