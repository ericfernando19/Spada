<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\Soal; // <-- TAMBAHKAN
use App\Models\SubMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    /**
     * Menyimpan tugas baru berdasarkan tipe (upload / posttest)
     */
    public function store(Request $request, $id) // $id adalah sub_materi_id
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:upload,posttest', // <-- DIUBAH
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|max:102400', // 100MB
            'deadline' => 'nullable|date',
        ]);

        $path = null;
        $tipe = $request->tipe;

        // Hanya proses file jika tipenya 'upload'
        if ($tipe == 'upload' && $request->hasFile('file')) {
            $path = $request->file('file')->store('tugas', 'public');
        }

        $tugas = Tugas::create([
            'sub_materi_id' => $id,
            'judul' => $request->judul,
            'tipe' => $tipe,
            'deskripsi' => ($tipe == 'upload') ? $request->deskripsi : null,
            'deadline' => ($tipe == 'upload') ? $request->deadline : null,
            'file' => $path,
        ]);

        // =======================================================
        // LOGIKA REDIRECT BARU
        // =======================================================
        if ($tipe == 'posttest') {
            // Arahkan ke halaman 'manage soal' yang baru
            return redirect()
                ->route('guru.tugas.manageSoal', ['tugas' => $tugas->id])
                ->with('success', 'Posttest berhasil dibuat! Silakan tambahkan soal.');
        }

        // Jika tipenya 'upload', kembali ke halaman sebelumnya
        return back()->with('success', 'Tugas (upload file) berhasil ditambahkan.');
    }

    /**
     * FUNGSI BARU: Menampilkan halaman "Kelola Soal"
     * untuk satu posttest.
     */
    public function manageSoal($tugas_id)
    {
        $tugas = Tugas::findOrFail($tugas_id);

        // Pastikan ini adalah posttest, bukan tugas upload
        if ($tugas->tipe != 'posttest') {
             return redirect()->back()->with('error', 'Hanya posttest yang bisa dikelola soalnya.');
        }

        $soals = Soal::where('tugas_id', $tugas_id)->orderBy('created_at', 'asc')->get();

        return view('guru.tugas.manage_soal', compact('tugas', 'soals'));
    }

    public function update(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        $data = $request->only('judul', 'deskripsi', 'deadline');

        if ($tugas->tipe == 'upload' && $request->hasFile('file')) {
            $request->validate(['file' => 'nullable|file|max:102400']);
            if ($tugas->file && Storage::disk('public')->exists($tugas->file)) {
                Storage::disk('public')->delete($tugas->file);
            }
            $data['file'] = $request->file('file')->store('tugas', 'public');
        }

        $tugas->update($data);
        return back()->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);

        if ($tugas->file && Storage::disk('public')->exists($tugas->file)) {
            Storage::disk('public')->delete($tugas->file);
        }

        // Soal yang terhubung (via foreign key cascade) akan ikut terhapus
        $tugas->delete();
        return back()->with('success', 'Tugas/Posttest dihapus.');
    }

    // ... (fungsi 'nilai' Anda yang sudah ada) ...
    public function nilai(Request $request, $id)
    {
        // ...
    }
}
