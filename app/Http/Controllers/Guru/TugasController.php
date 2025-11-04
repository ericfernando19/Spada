<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\SubMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'file' => 'nullable|file|max:102400',
            'deadline' => 'nullable|date',
        ]);

        $path = $request->file('file') ? $request->file('file')->store('tugas', 'public') : null;

        Tugas::create([
            'sub_materi_id' => $id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            'file' => $path,
        ]);

        return back()->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);
        $path = $tugas->file;

        if ($request->hasFile('file')) {
            if ($path)
                Storage::disk('public')->delete($path);
            $path = $request->file('file')->store('tugas', 'public');
        }

        $tugas->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            'file' => $path,
        ]);

        return back()->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        if ($tugas->file)
            Storage::disk('public')->delete($tugas->file);
        $tugas->delete();

        return back()->with('success', 'Tugas dihapus.');
    }
    public function nilai(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string|max:500',
        ]);

        $tugas = Tugas::findOrFail($id);
        $tugas->nilai = $request->nilai;
        $tugas->catatan = $request->catatan;
        $tugas->save();

        return back()->with('success', 'Nilai tugas berhasil disimpan.');
    }

}
