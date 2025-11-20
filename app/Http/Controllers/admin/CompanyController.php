<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Menampilkan daftar semua perusahaan (Index)
     */
    public function index()
    {
        // Mengambil semua data perusahaan, diurutkan berdasarkan kolom 'nama_perusahaan'
        $companies = Company::orderBy('nama_perusahaan')->paginate(10); 

        return view('admin.companies.index', compact('companies'));
    }
    public function store(Request $request)
    {
        // 1. Validasi Data
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:companies,email',
            'password' => 'required|string|min:8',
            'nama_perusahaan' => 'required|string|max:255',
            'jumlah_karyawan' => 'required|integer',
            'industri' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'desa_kelurahan' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'is_active' => 'nullable|boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $validatedData;

        // 2. Hash password
        $data['password'] = bcrypt($request->password);

        // 3. Menyimpan Logo jika ada
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('company_logos', 'public');
        }

        // 4. Handle is_active (untuk checkbox)
        $data['is_active'] = $request->has('is_active');
        // HAPUS: $data['is_verified'] = false;
        
        // 5. Menyimpan ke Database
        Company::create($data);

        return redirect()
            ->route('admin.companies.index')
            ->with('success', 'Perusahaan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail perusahaan tertentu (Show) - TAMBAHKAN METHOD SHOW
     */
    public function show(Company $company)
    {
        return view('admin.companies.show', compact('company'));
    }

    public function destroy(Company $company)
    {
        // Hapus logo dari storage
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return redirect()
            ->route('admin.companies.index')
            ->with('success', 'Perusahaan berhasil dihapus!');
    }
}