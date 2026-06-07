<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    private function gateAdmin(): void
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }
    }

    public function index()
    {
        $this->gateAdmin();
        $users = User::orderBy('created_at')->get();
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $this->gateAdmin();
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => ['required', Password::min(8)],
            'role'     => 'required|in:admin,karyawan',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        AdminLog::catat('Tambah Admin', "User: {$user->name} ({$user->email})");

        return back()->with('sukses', "Admin \"{$user->name}\" berhasil ditambahkan.");
    }

    public function update(Request $request, User $user)
    {
        $this->gateAdmin();
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', Password::min(8)],
            'role'     => 'required|in:admin,karyawan',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        AdminLog::catat('Edit Admin', "User: {$user->name} ({$user->email})");

        return back()->with('sukses', "Admin \"{$user->name}\" berhasil diperbarui.");
    }

    public function destroy(User $user)
    {
        $this->gateAdmin();
        if ($user->id === auth()->user()->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
        }

        AdminLog::catat('Hapus Admin', "User: {$user->name} ({$user->email})");
        $user->delete();

        return back()->with('sukses', "Admin \"{$user->name}\" berhasil dihapus.");
    }
}
