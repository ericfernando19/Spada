<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Materi;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();
        return view('guru.matapelajaran.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('nama', 'deskripsi');

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('mata_pelajaran', 'public');
            $data['gambar'] = $path;
        }

        Course::create($data);

        return redirect()->back()->with('success', 'Mata pelajaran berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $course = Course::findOrFail($id);
        $data = $request->only('nama', 'deskripsi');

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('mata_pelajaran', 'public');
            $data['gambar'] = $path;
        }

        $course->update($data);

        return redirect()->back()->with('success', 'Mata pelajaran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->back()->with('success', 'Mata pelajaran berhasil dihapus!');
    }

    public function isi($id)
    {
        $course = Course::findOrFail($id);

        // sementara biar gak error, bikin koleksi kosong
        $materi = Materi::where('course_id', $id)->latest()->get();
        return view('guru.matapelajaran.isi', compact('course', 'materi'));
    }

}
