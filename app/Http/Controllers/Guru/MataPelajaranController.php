<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Materi;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $courses = Course::where('guru_id', Auth::id())
            ->with(['kelas', 'mataPelajaran']) // Tambahkan eager loading
            ->latest()
            ->get();
        $mataPelajaran = MataPelajaran::all(); // ambil semua mapel dari admin
        $kelas = Kelas::all(); // ambil semua kelas dari admin

        return view('guru.matapelajaran.index', compact('courses', 'mataPelajaran', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'kelas_id' => 'required|exists:kelas,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('mata_pelajaran_id', 'kelas_id');
        $data['guru_id'] = Auth::id();

        $mataPelajaran = MataPelajaran::findOrFail($request->mata_pelajaran_id);
        $kelas = Kelas::findOrFail($request->kelas_id);

        $data['nama'] = $mataPelajaran->nama_mapel;
        $data['deskripsi'] = 'Course untuk ' . $mataPelajaran->nama_mapel . ' di kelas ' . $kelas->nama_kelas;

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
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $course = Course::findOrFail($id);
        $data = [];

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('mata_pelajaran', 'public');
            $data['gambar'] = $path;
        }

        if (!empty($data)) {
            $course->update($data);
        }

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
        $materi = Materi::where('course_id', $id)->latest()->get();

        return view('guru.matapelajaran.isi', compact('course', 'materi'));
    }

    public function show($id)
    {
        $course = \App\Models\Course::findOrFail($id);
        $materis = \App\Models\Materi::where('course_id', $id)->get();
        $soals = \App\Models\Soal::whereIn('materi_id', $materis->pluck('id'))->get();

        return view('guru.matapelajaran.show', compact('course', 'materis', 'soals'));
    }

}
