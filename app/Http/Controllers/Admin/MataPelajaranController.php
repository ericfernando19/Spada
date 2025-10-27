<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::with('kelas')->get();
        return view('admin.mapel.index', compact('mapel'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.mapel.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kode_mapel' => 'required|unique:mata_pelajaran',
            'kelas_id' => 'required',
        ]);

        MataPelajaran::create($request->all());
        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $kelas = Kelas::all();
        return view('admin.mapel.edit', compact('mapel', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $mapel->update($request->all());
        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        MataPelajaran::destroy($id);
        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran dihapus.');
    }
}
