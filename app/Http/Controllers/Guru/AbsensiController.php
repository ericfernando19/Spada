<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    // Halaman input absensi
    public function index(Request $request)
    {
        // Ambil semua kelas unik untuk filter
        $kelasList = Siswa::select('kelas')->distinct()->pluck('kelas');

        // Filter berdasarkan kelas jika dipilih
        $query = Siswa::query();
        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('kelas', $request->kelas);
        }

        $siswas = $query->get();

        return view('guru.absensi.index', compact('siswas', 'kelasList'));
    }

    // Simpan absensi
    public function store(Request $request)
    {
        $dataAbsensi = $request->input('absensi');
        $jamMulai = $request->input('jam_mulai');
        $jamSelesai = $request->input('jam_selesai');
        $mapel = $request->input('mapel'); // Ambil mata pelajaran dari input

        foreach ($dataAbsensi as $siswaId => $absensi) {
            Absensi::create([
                'siswa_id' => $siswaId,
                'mapel' => $mapel,
                'status' => $absensi['status'],
                'keterangan' => $absensi['keterangan'] ?? null,
                'tanggal' => now()->toDateString(),
                'jam_mulai' => $jamMulai,
                'jam_selesai' => $jamSelesai,
            ]);
        }

        return redirect()->route('guru.absensi.index')->with('success', 'Absensi berhasil disimpan!');
    }

    // Halaman rekap absensi dengan filter kelas dan mapel
    public function rekap(Request $request)
    {
        // Daftar kelas dan mapel unik untuk dropdown filter
        $kelasList = Siswa::select('kelas')->distinct()->pluck('kelas');
        $mapelList = Absensi::select('mapel')->distinct()->pluck('mapel');

        // Query absensi dengan filter jika ada
        $rekap = Absensi::with('siswa')
            ->when($request->kelas, function ($q) use ($request) {
                $q->whereHas('siswa', function ($q2) use ($request) {
                    $q2->where('kelas', $request->kelas);
                });
            })
            ->when($request->mapel, function ($q) use ($request) {
                $q->where('mapel', $request->mapel);
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('guru.absensi.rekap', compact('rekap', 'kelasList', 'mapelList'));
    }

    // Optional: update absensi
    public function update(Request $request, $id)
    {
        $absen = Absensi::findOrFail($id);
        $absen->update([
            'status' => $request->status,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('guru.absensi.rekap')->with('success', 'Absensi berhasil diperbarui!');
    }

    // Optional: hapus absensi
    public function destroy($id)
    {
        $absen = Absensi::findOrFail($id);
        $absen->delete();

        return redirect()->route('guru.absensi.rekap')->with('success', 'Absensi berhasil dihapus!');
    }
}
