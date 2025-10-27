<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuruImport;
use App\Imports\SiswaImport;
use App\Models\User;

class ImportController extends Controller
{
    // Tampilkan form import sekaligus data guru & siswa yang sudah ada
    public function showForm()
    {
        // Ambil semua data guru dan siswa dari tabel users
        $gurus = User::where('role', 'guru')->get();
        $siswas = User::where('role', 'siswa')->get();

        // Kirim data ke view
        return view('admin.import.index', compact('gurus', 'siswas'));
    }

    // Import file Excel untuk akun guru
    public function importGuru(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new GuruImport, $request->file('file'));

        return redirect()->back()->with('success', 'Akun guru berhasil ditambahkan.');
    }

    // Import file Excel untuk akun siswa
    public function importSiswa(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->back()->with('success', 'Akun siswa berhasil ditambahkan.');
    }
}
