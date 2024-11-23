<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListLembur;
use Illuminate\Support\Facades\Auth;

class CrtLemburController extends Controller
{
    /**
     * Menampilkan form pengajuan lembur.
     */
    public function showLemburForm()
    {
        // Kirim data lembur ke view
        return view('crtlembur');
    }

    public function showApprovalForm()
    {
        $lemburData = ListLembur::all();
        // Kirim data lembur ke view
        return view('approval', compact('lemburData'));
        
    }



    // Fungsi untuk approve lembur
    public function approve($id)
    {
        $lembur = ListLembur::find($id);
        if ($lembur) {
            $lembur->status = 'Approved'; // Mengubah status menjadi Approved
            $lembur->save();
            return redirect()->route('dashboard')->with('success', 'Lembur berhasil disetujui!');
        }
        return back()->with('error', 'Data lembur tidak ditemukan.');
    }

    // Fungsi untuk reject lembur
    public function reject($id)
    {
        $lembur = ListLembur::find($id);
        if ($lembur) {
            $lembur->status = 'Rejected'; // Mengubah status menjadi Rejected
            $lembur->save();
            return redirect()->route('dashboard')->with('success', 'Lembur berhasil ditolak!');
        }
        return back()->with('error', 'Data lembur tidak ditemukan.');
    }

    public function showDataLemburForm(Request $request)
    {
        // Ambil semua data pengajuan lembur dari database
        $lemburData = ListLembur::all();
        // Hitung Total Pengajuan Lembur
        $lemburCount = ListLembur::countLembur();
        $lemburCountP = ListLembur::countLemburP();
        $lemburCountR = ListLembur::countLemburR();
        $lemburCountS = ListLembur::countLemburS();
       
       //----------------------------------------------------------------------------
        // $lemburCountUser = ListLembur::countLemburUser($id); 
        $name = Auth::user()->name;
        $lemburCountUser = ListLembur::countLemburUser($name);
        $lemburCountUS = ListLembur::countLemburUS($name);
        $lemburCountUP = ListLembur::countLemburUP($name);
        $lemburCountUR = ListLembur::countLemburUR($name);
      //----------------------------------------------------------------------------

        // Mendapatkan data user yang sedang login
         $user = Auth::user();
        
         // Cek role user
         if ($user->role == 'admin') {
            // Jika admin, arahkan ke halaman admin
            
            return view('admindashboard', compact('lemburData', 'lemburCount','lemburCountP','lemburCountR','lemburCountS'));
        } else {
            // Jika user biasa, arahkan ke dashboard biasa
            return view('dashboard', compact('lemburData', 'lemburCountUser','lemburCountUS','lemburCountUP','lemburCountUR'));

        }

    }
 





    /**
     * Menyimpan pengajuan lembur ke database.
     */
    public function crtlembur(Request $request)
{
    try {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'jml_lembur' => 'required|numeric|min:0.1',
            'keterangan' => 'required|string|max:500',
           // 'status' => 'required|string|max:255',
        ]);

        ListLembur::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'division' => $request->division,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'jml_lembur' => $request->jml_lembur,
            'keterangan' => $request->keterangan,
         //   'status' => $request->status,
        ]);
        
        return redirect()->route('dashboard')->with('success', 'Pengajuan lembur berhasil disimpan!');
    } catch (\Exception $e) {
       
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

}