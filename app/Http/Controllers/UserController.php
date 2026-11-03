<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Manages user records (administrators and customers).
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Supports searching and filtering by role.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search by name, email or phone number.
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%");
            });
        }

        // Filter by role.
        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // The password is always hashed before it is stored.
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        // Prevent changing own role or deactivating own admin account.
        if (Auth::id() === $user->id && ($request->role !== 'admin' || $request->status !== 'Aktif')) {
            return back()->with('error', 'Anda tidak dapat menurunkan hak akses atau menonaktifkan akun admin Anda sendiri.');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'status' => $request->status,
        ];

        // Only change the password when a new one was provided.
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting own account or the main admin account.
        if (Auth::id() === $user->id || $user->email === 'attaerpeel@gmail.com') {
            return back()->with('error', 'Akun Administrator utama tidak dapat dihapus untuk mencegah kehilangan hak akses.');
        }

        // Users with an order history cannot be deleted.
        if ($user->orders()->exists()) {
            return back()->with('error', 'Pengguna tidak dapat dihapus karena memiliki riwayat transaksi pemesanan tiket.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
