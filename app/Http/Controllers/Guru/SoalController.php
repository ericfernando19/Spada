<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Soal;
use App\Models\Tugas; // <-- TAMBAHKAN
use Illuminate\Http\Request;

class SoalController extends Controller
{

    // =======================================================
    // FUNGSI LAMA (Soal untuk Latihan di Materi)
    // =======================================================

    public function create($materi_id)
    {
        $materi = Materi::findOrFail($materi_id);
        return view('guru.soal.create', compact('materi'));
    }

    public function index($materi_id)
    {
        $materi = Materi::findOrFail($materi_id);
        $soals = Soal::where('materi_id', $materi_id)->get();
        return view('guru.soal.index', compact('materi', 'soals'));
    }

    public function store(Request $request, $materi_id)
    {
        $data = $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban_benar' => 'required|string|in:A,B,C,D',
        ]);

        Soal::create([
            'materi_id' => $materi_id,
            'tipe_soal' => 'pilgan',
            'pertanyaan' => $data['pertanyaan'],
            'pilihan_a' => $data['opsi_a'],
            'pilihan_b' => $data['opsi_b'],
            'pilihan_c' => $data['opsi_c'],
            'pilihan_d' => $data['opsi_d'],
            'jawaban_benar' => $data['jawaban_benar'],
        ]);

        return redirect()->route('guru.soal.index', $materi_id)->with('success', 'Soal latihan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return redirect()->back()->with('success', 'Soal berhasil dihapus.');
    }


    // =======================================================
    // FUNGSI BARU (Menyimpan Soal untuk POSTTEST)
    // =======================================================

    /**
     * Menyimpan soal (Pilgan ATAU Esai) ke TUGAS/POSTTEST
     * dan kembali ke halaman 'manage_soal'.
     */
    public function storeForTugas(Request $request, $tugas_id)
    {
        $tugas = Tugas::findOrFail($tugas_id);
        $tipe_soal = $request->input('tipe_soal'); // Ambil tipe dari hidden input

        $data = [
            'tugas_id' => $tugas_id,
            'tipe_soal' => $tipe_soal,
            'pertanyaan' => $request->pertanyaan,
        ];

        if ($tipe_soal == 'pilgan') {
            $request->validate([
                'pertanyaan' => 'required|string',
                'opsi_a' => 'required|string',
                'opsi_b' => 'required|string',
                'opsi_c' => 'required|string',
                'opsi_d' => 'required|string',
                'jawaban_benar' => 'required|string|in:A,B,C,D',
            ]);

            $data['pilihan_a'] = $request->opsi_a;
            $data['pilihan_b'] = $request->opsi_b;
            $data['pilihan_c'] = $request->opsi_c;
            $data['pilihan_d'] = $request->opsi_d;
            $data['jawaban_benar'] = $request->jawaban_benar;

        } elseif ($tipe_soal == 'esai') {
            $request->validate([
                'pertanyaan' => 'required|string',
            ]);
            // Kolom pilihan ganda akan otomatis NULL
        } else {
            return back()->with('error', 'Tipe soal tidak valid.');
        }

        Soal::create($data);

        // Kembali ke halaman 'manage soal'
        return redirect()
            ->route('guru.tugas.manageSoal', ['tugas' => $tugas_id])
            ->with('success', 'Soal ' . $tipe_soal . ' berhasil ditambahkan.');
    }
}
