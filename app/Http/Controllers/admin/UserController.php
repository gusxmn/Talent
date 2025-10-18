<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        $search   = $request->input('search');
        $perPage  = $request->input('per_page', 5); // default tampil 5 data

        $users = User::when($search, function ($query, $search) {
                    return $query->where('name', 'like', "%{$search}%")
                                 ->orWhere('email', 'like', "%{$search}%")
                                 ->orWhere('role', 'like', "%{$search}%");
                })
                ->orderBy('id', 'desc')
                ->paginate($perPage);

        
        $users->appends([
            'search'   => $search,
            'per_page' => $perPage,
        ]);

        
        $totalAdmin = User::where('role', 'admin')->count();
        $totalWawancara = User::where('role', 'wawancara')->count();
        $totalPimpinan = User::where('role', 'pimpinan')->count();
        $totalUser = User::where('role', 'user')->count();

        
        $roleStats = [
            'admin' => $totalAdmin,
            'wawancara' => $totalWawancara,
            'pemimpin' => $totalPimpinan,
            'user' => $totalUser,
        ];

        return view('admin.users.index', compact(
            'users', 
            'search', 
            'perPage',
            'totalAdmin',
            'totalWawancara',
            'totalPimpinan',
            'totalUser',
            'roleStats'
        ));
    }

    
    public function create()
    {
        return view('admin.users.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|string',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'User berhasil ditambahkan.');
    }

    
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'role'     => 'required|string',
        ]);

        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->role      = $request->role;
        $user->is_active = $request->has('is_active');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')
                         ->with('success', 'User berhasil diperbarui.');
    }

    
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'User berhasil dihapus.');
    }

    
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
}