<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalGuru = User::where('role', 'guru')->count();
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalAdmin = User::where('role', 'admin')->count();

        return view('admin.dashboard', compact('user', 'totalGuru', 'totalSiswa', 'totalAdmin'));
    }
}
