<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function showRoleForm()
    {
        $roledata = User::all(); // Ambil semua data pengguna
        return view('role', compact('roledata'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id); // Temukan pengguna berdasarkan ID
        
        // Jika role kosong, atur null, jika tidak, gunakan input role
        $user->role = $request->input('role') ?: null;
        $user->save(); // Simpan perubahan
    
        return redirect()->route('role')->with('success', 'Role berhasil diperbarui.');
    }
    
}
