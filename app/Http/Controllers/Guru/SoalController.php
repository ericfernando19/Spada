<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{

    public function create($materi_id)
    {
        $materi = Materi::findOrFail($materi_id);
        return view('guru.soal.create', compact('materi'));
    }

    // Menampilkan daftar soal berdasarkan materi
    public function index($materi_id)
    {
        $materi = Materi::findOrFail($materi_id);
        $soals = Soal::where('materi_id', $materi_id)->get();

        return view('guru.soal.index', compact('materi', 'soals'));
    }

    // Menyimpan soal baru
    public function store(Request $request, $materi_id)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban_benar' => 'required|string|in:A,B,C,D',
        ]);

        Soal::create([
            'materi_id' => $materi_id,
            'pertanyaan' => $request->pertanyaan,
            'pilihan_a' => $request->opsi_a,
            'pilihan_b' => $request->opsi_b,
            'pilihan_c' => $request->opsi_c,
            'pilihan_d' => $request->opsi_d,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return back()->with('success', '✅ Soal berhasil ditambahkan.');
    }

    // Menghapus soal
    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return back()->with('success', '🗑️ Soal berhasil dihapus.');
    }
}
