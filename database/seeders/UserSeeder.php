<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Admin Sekolah',
                'username' => 'admin@sekolah.id',
                'password' => 'admin123',
                'role' => 'admin',
            ],
            [
                'nama' => 'Budi Guru',
                'username' => '1987120420220001', // NIP guru
                'password' => 'guru123',
                'role' => 'guru',
            ],
            [
                'nama' => 'Ani Siswa',
                'username' => '1234567890', // NISN siswa
                'password' => 'siswa123',
                'role' => 'siswa',
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['username' => $data['username']], // cek berdasarkan username
                [
                    'nama' => $data['nama'],
                    'password' => Hash::make($data['password']),
                    'role' => $data['role'],
                ]
            );
        }
    }
}
