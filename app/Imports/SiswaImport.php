<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'nama' => $row[0],          // nama siswa
            'username' => $row[1],      // NISN
            'password' => Hash::make('siswa123'), // default password
            'role' => 'siswa',
        ]);
    }
}
