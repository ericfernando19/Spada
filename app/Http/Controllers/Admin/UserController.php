<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);

        // 🚫 Nonaktifkan cache supaya halaman edit tidak tersimpan di browser
        return response()
            ->view('admin.import.edit', compact('user'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['nama', 'username']));

        // ✅ Arahkan ke halaman form import, bukan kembali ke edit
        return redirect()
            ->route('import.form')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // ✅ Setelah hapus, juga kembali ke halaman utama import
        return redirect()
            ->route('import.form')
            ->with('success', 'Data pengguna berhasil dihapus.');
    }
}
