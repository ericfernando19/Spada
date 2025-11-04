<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Course;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        Materi::create([
            'course_id' => $courseId,
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);

        return back()->with('success', 'Materi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        $materi->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);

        return back()->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Materi::findOrFail($id)->delete();
        return back()->with('success', 'Materi berhasil dihapus!');
    }
}
