<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::latest()->paginate(10);
        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nisn' => 'required|unique:siswas',
            'kelas' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required',
            'nisn' => 'required|unique:siswas,nisn,' . $siswa->id,
            'kelas' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ]);

        $siswa->update([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
