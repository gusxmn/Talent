<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company; // Pastikan Model Anda bernama 'Company'
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Tambahkan ini untuk membuat slug

class CompanyController extends Controller
{
    /**
     * Menampilkan daftar semua perusahaan (Index)
     */
    public function index()
    {
        // Mengambil semua data perusahaan, diurutkan berdasarkan kolom 'nama'
        $companies = Company::orderBy('nama')->paginate(10); 

        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Menampilkan form untuk membuat perusahaan baru (Create)
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Menyimpan data perusahaan baru ke database (Store)
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|unique:companies,nama',
            'deskripsi' => 'required|string',
            'industri' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Maks 2MB
        ]);

        $data = $validatedData;

        // 2. Tambahkan SLUG secara otomatis
        $data['slug'] = Str::slug($request->nama);

        // 3. Menyimpan Logo jika ada
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('company_logos', 'public');
        }

        // 4. Handle is_active (untuk checkbox)
        $data['is_active'] = $request->has('is_active');
        
        // 5. Menyimpan ke Database
        Company::create($data);

        return redirect()
            ->route('admin.companies.index')
            ->with('success', 'Perusahaan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail perusahaan tertentu (Show)
     */
    public function show(Company $company)
    {
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Menampilkan form untuk mengedit perusahaan (Edit)
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Memperbarui data perusahaan di database (Update)
     */
    public function update(Request $request, Company $company)
    {
        // 1. Validasi Data
        $validatedData = $request->validate([
            // Abaikan ID saat ini untuk aturan 'unique' pada kolom 'nama'
            'nama' => 'required|string|max:255|unique:companies,nama,' . $company->id,
            'deskripsi' => 'required|string',
            'industri' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        $data = $validatedData;
        
        // 2. Perbarui SLUG jika nama berubah
        if ($request->nama !== $company->nama) {
            $data['slug'] = Str::slug($request->nama);
        } else {
            // Pastikan slug tidak diubah jika nama tidak berubah
            unset($data['slug']);
        }

        // 3. Memproses update logo
        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            // Simpan logo baru
            $data['logo'] = $request->file('logo')->store('company_logos', 'public');
        } else {
            // Hapus 'logo' dari array $data agar tidak menimpa logo lama
            unset($data['logo']);
        }
        
        // 4. Handle is_active
        $data['is_active'] = $request->has('is_active');

        // 5. Memperbarui Database
        $company->update($data);

        return redirect()
            ->route('admin.companies.index')
            ->with('success', 'Data perusahaan berhasil diperbarui!');
    }

    /**
     * Menghapus perusahaan dari database (Destroy)
     */
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