<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index($materi_id)
    {
        $materi = Materi::findOrFail($materi_id);
        $soals = Soal::where('materi_id', $materi_id)->get();
        return view('guru.soal.index', compact('materi', 'soals'));
    }

    public function store(Request $request, $materi_id)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'nullable|string',
            'pilihan_b' => 'nullable|string',
            'pilihan_c' => 'nullable|string',
            'pilihan_d' => 'nullable|string',
            'jawaban_benar' => 'required|string|in:A,B,C,D',
        ]);

        Soal::create([
            'materi_id' => $materi_id,
            'pertanyaan' => $request->pertanyaan,
            'pilihan_a' => $request->pilihan_a,
            'pilihan_b' => $request->pilihan_b,
            'pilihan_c' => $request->pilihan_c,
            'pilihan_d' => $request->pilihan_d,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return back()->with('success', 'Soal berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();
        return back()->with('success', 'Soal berhasil dihapus.');
    }
}
