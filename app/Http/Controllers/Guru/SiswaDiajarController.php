<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Siswa;

class SiswaDiajarController extends Controller
{
    /**
     * Menampilkan daftar siswa yang diajar oleh guru yang sedang login.
     * Siswa yang diajar adalah siswa yang terdaftar di kelas yang memiliki mata pelajaran
     * yang diajar oleh guru tersebut.
     */
    public function index()
    {
        // Mendapatkan ID pengguna (Guru) yang sedang login
        $guruId = Auth::id();

        // 1. Ambil semua Course (Mata Pelajaran) yang diajar oleh guru ini
        // Course adalah Mata Pelajaran yang diampu oleh Guru di Kelas tertentu.
        $courses = Course::where('guru_id', $guruId)->get();

        // 2. Ambil semua ID Kelas dari courses tersebut
        // Ini akan menghasilkan daftar unik kelas yang diajar oleh guru.
        $kelasIds = $courses->pluck('kelas_id')->unique()->toArray();

        // 3. Ambil semua Siswa yang terdaftar di kelas-kelas tersebut
        // Menggunakan eager loading untuk relasi 'kelas' agar nama kelas bisa ditampilkan.
        $siswaDiajar = Siswa::whereIn('kelas_id', $kelasIds)
                            ->with('kelas')
                            ->orderBy('kelas_id')
                            ->orderBy('nama')
                            ->get();

        // Mengirim data ke view
        return view('guru.siswa-diajar.index', compact('siswaDiajar'));
    }
}
