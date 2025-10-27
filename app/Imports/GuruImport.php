<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class GuruImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'nama' => $row[0],          // nama guru
            'username' => $row[1],      // NIP
            'password' => Hash::make('guru123'), // default password
            'role' => 'guru',
        ]);
    }
}
