<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\SubMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubMateriController extends Controller
{
    public function store(Request $request, $materiId)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,mp4,avi,doc,docx,ppt,pptx,jpg,jpeg,png|max:102400',
        ]);

        $submateri = new SubMateri();
        $submateri->materi_id = $materiId;
        $submateri->judul = $request->judul;
        $submateri->konten = $request->konten;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('submateri_files', 'public');
            $submateri->file = $path;
        }

        $submateri->save();

        return redirect()->back()->with('success', 'Submateri berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,mp4,avi,doc,docx,ppt,pptx,jpg,jpeg,png|max:102400',
        ]);

        $submateri = SubMateri::findOrFail($id);
        $submateri->judul = $request->judul;
        $submateri->konten = $request->konten;

        if ($request->hasFile('file')) {
            if ($submateri->file && Storage::disk('public')->exists($submateri->file)) {
                Storage::disk('public')->delete($submateri->file);
            }
            $path = $request->file('file')->store('submateri_files', 'public');
            $submateri->file = $path;
        }

        $submateri->save();

        return redirect()->back()->with('success', 'Submateri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $submateri = SubMateri::findOrFail($id);

        if ($submateri->file && Storage::disk('public')->exists($submateri->file)) {
            Storage::disk('public')->delete($submateri->file);
        }

        $submateri->delete();

        return redirect()->back()->with('success', 'Submateri berhasil dihapus!');
    }
}
