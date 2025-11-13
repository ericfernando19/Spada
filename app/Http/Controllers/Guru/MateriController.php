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

        $materi = new \App\Models\Materi();
        $materi->course_id = $courseId;
        $materi->judul = $request->judul;
        $materi->konten = $request->konten;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('materi', 'public');
            $materi->file = $path;
        }

        $materi->save();

        return redirect()->back()->with('success', 'Materi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,webm,pdf|max:10240'
        ]);

        $materi = \App\Models\Materi::findOrFail($id);
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

        return redirect()->back()->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Materi::findOrFail($id)->delete();
        return back()->with('success', 'Materi berhasil dihapus!');
    }

    public function create($courseId)
    {
        $course = \App\Models\Course::findOrFail($courseId);
        return view('guru.materi.create', compact('course'));
    }

}
