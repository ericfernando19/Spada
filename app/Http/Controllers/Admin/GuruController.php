<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();
        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        // 🚫 Nonaktifkan cache agar saat klik back tidak balik ke form create lama
        return response()
            ->view('admin.guru.create')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:gurus',
            'no_hp' => 'nullable',
            'mata_pelajaran' => 'required',
        ]);

        Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'no_hp' => $request->no_hp,
            'mata_pelajaran' => $request->mata_pelajaran,
        ]);

        // ✅ arahkan ke halaman index agar “back” tidak muter ke form create
        return redirect()->route('guru.index')
            ->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit(Guru $guru)
    {
        // 🚫 Nonaktifkan cache agar back tidak buka form edit lama dari cache browser
        return response()
            ->view('admin.guru.edit', compact('guru'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:gurus,nip,' . $guru->id,
            'no_hp' => 'nullable',
            'mata_pelajaran' => 'required',
        ]);

        $guru->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'no_hp' => $request->no_hp,
            'mata_pelajaran' => $request->mata_pelajaran,
        ]);

        // ✅ redirect ke index supaya tidak balik ke form edit
        return redirect()->route('guru.index')
            ->with('success', 'Data guru berhasil diperbarui');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('guru.index')
            ->with('success', 'Guru berhasil dihapus');
    }
}
