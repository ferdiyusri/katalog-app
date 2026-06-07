<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TimController extends Controller
{
    public function index()
    {
        $tim = TeamMember::orderBy('urutan')->get();
        return view('admin.tim.index', compact('tim'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'role'  => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $photo  = $request->hasFile('photo') ? $request->file('photo')->store('team', 'public') : null;
        $urutan = (TeamMember::max('urutan') ?? 0) + 1;

        $anggota = TeamMember::create([
            'name'     => $request->name,
            'role'     => $request->role,
            'initials' => $this->buatInisial($request->name),
            'photo'    => $photo,
            'urutan'   => $urutan,
        ]);

        AdminLog::catat('Tambah Tim', "Anggota: {$anggota->name} ({$anggota->role})");

        return back()->with('sukses', "Anggota \"{$anggota->name}\" berhasil ditambahkan.");
    }

    public function update(Request $request, TeamMember $tim)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'role'  => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'name'     => $request->name,
            'role'     => $request->role,
            'initials' => $this->buatInisial($request->name),
        ];

        if ($request->hasFile('photo')) {
            if ($tim->photo) {
                Storage::disk('public')->delete($tim->photo);
            }
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        $tim->update($data);
        AdminLog::catat('Edit Tim', "Anggota: {$tim->name}");

        return back()->with('sukses', "Anggota \"{$tim->name}\" berhasil diperbarui.");
    }

    public function destroy(TeamMember $tim)
    {
        if ($tim->photo) {
            Storage::disk('public')->delete($tim->photo);
        }
        AdminLog::catat('Hapus Tim', "Anggota: {$tim->name}");
        $tim->delete();

        return back()->with('sukses', "Anggota \"{$tim->name}\" berhasil dihapus.");
    }

    private function buatInisial(string $name): string
    {
        $words = array_filter(explode(' ', $name));
        return strtoupper(
            collect($words)->take(2)->map(fn($w) => substr($w, 0, 1))->join('')
        );
    }
}
