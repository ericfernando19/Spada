<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MateriController extends Controller
{
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,webm,pdf|max:10240'
        ]);

        // PERBAIKAN: Gunakan 'new Materi()' karena sudah di-import di atas
        $materi = new Materi();
        $materi->course_id = $courseId;
        $materi->judul = $request->judul;
        $materi->konten = $request->konten;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('materi', 'public');
            $materi->file = $path;
        }

        $materi->save();

        // INI SUDAH BENAR: Redirect ke halaman 'isi' dengan ID
        return redirect()->route('guru.mata-pelajaran.isi', $courseId)
                         ->with('success', 'Materi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,webm,pdf|max:10240'
        ]);

        // PERBAIKAN: Gunakan 'Materi::'
        $materi = Materi::findOrFail($id);
        $materi->judul = $request->judul;
        $materi->konten = $request->konten;

        if ($request->hasFile('file')) {
            // hapus file lama kalau ada
            if ($materi->file && Storage::disk('public')->exists($materi->file)) {
                Storage::disk('public')->delete($materi->file);
            }
            $materi->file = $request->file('file')->store('materi', 'public');
        }

        $materi->save();

        // PERBAIKAN: Redirect kembali ke halaman 'isi', bukan 'back()'
        // Ini lebih konsisten dan menghindari error.
        return redirect()->route('guru.mata-pelajaran.isi', $materi->course_id)
                         ->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // PERBAIKAN: Logika hapus file
        $materi = Materi::findOrFail($id);
        $course_id = $materi->course_id; // Simpan ID course untuk redirect

        // 1. Hapus file dari storage jika ada
        if ($materi->file && Storage::disk('public')->exists($materi->file)) {
            Storage::disk('public')->delete($materi->file);
        }

        // 2. Hapus data dari database
        $materi->delete();

        // PERBAIKAN: Redirect kembali ke halaman 'isi'
        return redirect()->route('guru.mata-pelajaran.isi', $course_id)
                         ->with('success', 'Materi berhasil dihapus!');
    }

    /**
     * PERBAIKAN BESAR:
     * Menggunakan Route Model Binding (Course $course)
     * Ini JAUH lebih baik dan sesuai dengan rute Anda di web.php
     * (Route::get('/materi/create/{course}', ...))
     */
    public function create(Course $course)
    {
        // HAPUS BARIS INI: $course = \App\Models\Course::findOrFail($courseId);
        // Laravel sudah otomatis mengambil data course untuk Anda.

        return view('guru.materi.create', compact('course'));
    }

}
