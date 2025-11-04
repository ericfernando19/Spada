<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard guru
     */
    public function index()
    {
        $user = Auth::user();
        $jumlahPelajaran = Course::count();

        return view('guru.dashboard', compact('user'));
    }

    /**
     * Tampilkan halaman kelola mata pelajaran
     */
    public function mataPelajaran()
    {
        $user = Auth::user();
        return view('guru.mata-pelajaran', compact('user'));
    }
}
