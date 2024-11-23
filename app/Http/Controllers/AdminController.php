<?php

namespace App\Http\Controllers;

use App\Models\ListLembur;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan halaman admin dengan daftar lembur
    public function index()
    {
        $lemburs = ListLembur::all();  // Ambil semua lembur
        return view('admin.dashboard', compact('lemburs'));
    }

    // Menyetujui lembur
    public function approve($id)
    {
        $lembur = ListLembur::findOrFail($id);
        $lembur->status = 'approved';  // Set status ke 'approved'
        $lembur->save();

        return redirect()->route('admin.lembur.index')->with('success', 'Lembur disetujui!');
    }

    // Menolak lembur
    public function reject($id)
    {
        $lembur = ListLembur::findOrFail($id);
        $lembur->status = 'rejected';  // Set status ke 'rejected'
        $lembur->save();

        return redirect()->route('admin.lembur.index')->with('success', 'Lembur ditolak!');
    }
}
