<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyRegistrationSuccess;

class RegisterController extends Controller
{
    /**
     * Menampilkan form langkah 1 - Data Diri
     */
    public function showStep1()
    {
        return view('company_register');
    }

    /**
     * Proses data langkah 1 - Data Diri
     */
    public function processStep1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'jabatan' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan data step 1 ke session (HANYA data form, tanpa file)
        $step1Data = $request->only(['nama_lengkap', 'no_hp', 'jabatan', 'email', 'password']);
        $request->session()->put('company_register.step1', $step1Data);

        return redirect()->route('company.register.process');
    }

    /**
     * Menampilkan form langkah 2 - Data Perusahaan
     */
    public function showStep2()
    {
        if (!session('company_register.step1')) {
            return redirect()->route('company.register')
                ->with('error', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        return view('company_register_process');
    }

    /**
     * Proses data langkah 2 - Data Perusahaan
     */
    public function processStep2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required|string|max:255',
            'jumlah_karyawan' => 'required|string|max:50',
            'industri' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Pastikan folder temp_company_logos ada
        if (!Storage::disk('public')->exists('temp_company_logos')) {
            Storage::disk('public')->makeDirectory('temp_company_logos');
        }

        // Simpan file logo ke storage sementara
        $logoPath = null;
        if ($request->hasFile('logo')) {
            try {
                $logoPath = $request->file('logo')->store('temp_company_logos', 'public');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'Gagal mengunggah logo: ' . $e->getMessage())
                    ->withInput();
            }
        }

        // Simpan data step 2 ke session (HANYA data form + path logo, tanpa UploadedFile object)
        $step2Data = $request->only(['nama_perusahaan', 'jumlah_karyawan', 'industri']);
        $step2Data['logo_path'] = $logoPath;
        
        $request->session()->put('company_register.step2', $step2Data);

        return redirect()->route('company.register.location');
    }

    /**
     * Menampilkan form langkah 3 - Lokasi Perusahaan
     */
    public function showStep3()
    {
        if (!session('company_register.step2')) {
            return redirect()->route('company.register')
                ->with('error', 'Silakan lengkapi data perusahaan terlebih dahulu.');
        }

        return view('company_register_location');
    }

    /**
     * Proses data langkah 3 - Lokasi Perusahaan dan Simpan ke Database
     */
    public function processStep3(Request $request)
    {
        // Debug: Cek session data
        Log::info('Session data step1:', session('company_register.step1') ?? []);
        Log::info('Session data step2:', session('company_register.step2') ?? []);

        $validator = Validator::make($request->all(), [
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'desa_kelurahan' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed:', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Ambil semua data dari session
        $step1 = session('company_register.step1');
        $step2 = session('company_register.step2');

        if (!$step1 || !$step2) {
            Log::error('Session data missing', ['step1' => $step1, 'step2' => $step2]);
            return redirect()->route('company.register')
                ->with('error', 'Sesi pendaftaran telah kadaluarsa. Silakan daftar kembali.');
        }

        try {
            // Pastikan folder company_logos ada
            if (!Storage::disk('public')->exists('company_logos')) {
                Storage::disk('public')->makeDirectory('company_logos');
            }

            // Pindahkan logo dari temp ke permanent location
            $permanentLogoPath = null;
            if (!empty($step2['logo_path']) && Storage::disk('public')->exists($step2['logo_path'])) {
                $tempPath = $step2['logo_path'];
                $filename = 'logo_' . time() . '_' . uniqid() . '.' . pathinfo($tempPath, PATHINFO_EXTENSION);
                $permanentPath = 'company_logos/' . $filename;
                
                // Pindahkan file dari temp ke permanent
                Storage::disk('public')->move($tempPath, $permanentPath);
                $permanentLogoPath = $permanentPath;
            }

            // GUNAKAN MANUAL SAVE
            $company = new Company();
            $company->nama_lengkap = $step1['nama_lengkap'];
            $company->no_hp = $step1['no_hp'];
            $company->jabatan = $step1['jabatan'];
            $company->email = $step1['email'];
            $company->password = Hash::make($step1['password']);
            $company->nama_perusahaan = $step2['nama_perusahaan'];
            $company->jumlah_karyawan = $step2['jumlah_karyawan'];
            $company->industri = $step2['industri'];
            $company->logo = $permanentLogoPath;
            $company->provinsi = $request->provinsi;
            $company->kota = $request->kota;
            $company->kecamatan = $request->kecamatan; // Data baru
            $company->desa_kelurahan = $request->desa_kelurahan; // Data baru
            $company->alamat_lengkap = $request->alamat_lengkap;
            $company->is_active = true;
            
            // Simpan manual
            $company->save();

            Log::info('Company registration successful', [
                'company_id' => $company->id,
                'email' => $company->email
            ]);

            // ✅ KIRIM EMAIL NOTIFIKASI SETELAH REGISTRASI BERHASIL
            try {
                Mail::to($company->email)->send(new CompanyRegistrationSuccess($company));
                
                Log::info('Registration email sent successfully', [
                    'to' => $company->email,
                    'company_id' => $company->id,
                    'sent_at' => now()
                ]);
                
            } catch (\Exception $emailException) {
                Log::error('Failed to send registration email', [
                    'to' => $company->email,
                    'error' => $emailException->getMessage(),
                    'company_id' => $company->id
                ]);
                // Jangan gagalkan proses pendaftaran hanya karena email gagal
            }

            // Hapus session setelah berhasil dibuat
            $request->session()->forget('company_register');

            // Login otomatis perusahaan
            auth()->guard('company')->login($company);

            return redirect()->route('company.dashboard')
                ->with('registration_success', 'Kami telah mengirimkan email konfirmasi ke ' . $company->email);

        } catch (\Exception $e) {
            Log::error('Company registration failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'session_step1' => $step1,
                'session_step2' => $step2
            ]);

            // Clean up: hapus file temp jika ada error
            if (isset($step2['logo_path']) && Storage::disk('public')->exists($step2['logo_path'])) {
                Storage::disk('public')->delete($step2['logo_path']);
            }
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Clean up temporary files jika user cancel pendaftaran
     */
    public function cancelRegistration(Request $request)
    {
        $step2 = session('company_register.step2');
        
        // Hapus file temp jika ada
        if ($step2 && isset($step2['logo_path']) && Storage::disk('public')->exists($step2['logo_path'])) {
            Storage::disk('public')->delete($step2['logo_path']);
        }
        
        // Hapus session
        $request->session()->forget('company_register');
        
        return redirect()->route('company.register')
            ->with('info', 'Pendaftaran dibatalkan.');
    }
}