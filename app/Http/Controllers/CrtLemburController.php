<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
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

    public function preview($id)
    {
        $lembur = ListLembur::find($id);

        if ($lembur && $lembur->upload_doc) {
            // Cek apakah file ada dan tersedia
            $filePath = storage_path('app/public/' . $lembur->upload_doc);

            // Cek apakah file ada di path
            if (file_exists($filePath)) {
                return response()->file($filePath); // Mengembalikan file untuk ditampilkan
            }

            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return redirect()->back()->with('error', 'Data lembur tidak ditemukan.');
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
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Ambil data lembur berdasarkan user role
        if ($user->role == 'Admin' or $user->role == 'IT Head' or $user->role == 'IT test') {
            $lemburData = ListLembur::all(); // Admin melihat semua data lembur
        } else {
            $lemburData = ListLembur::where('user_id', $user->id)->get(); // User biasa melihat data lembur mereka sendiri
        }

        // Hitung total pengajuan lembur (global)
        $lemburCount = ListLembur::count();
        $lemburCountP = ListLembur::where('status', 'Pending')->count();
        $lemburCountR = ListLembur::where('status', 'Rejected')->count();
        $lemburCountS = ListLembur::where('status', 'Success')->count();

        // Hitung total pengajuan lembur oleh user login
        $lemburCountUser = ListLembur::where('user_id', $user->id)->count();
        $lemburCountUS = ListLembur::where('user_id', $user->id)->where('status', 'Success')->count();
        $lemburCountUP = ListLembur::where('user_id', $user->id)->where('status', 'Pending')->count();
        $lemburCountUR = ListLembur::where('user_id', $user->id)->where('status', 'Rejected')->count();


        // Ubah format tanggal di lemburData
            $lemburData->transform(function ($item) {
                $item->tanggal = Carbon::parse($item->tanggal)->format('d-m-Y'); // Format EUR
                return $item;
            });
        // Cek role user dan arahkan ke view yang sesuai
        if ($user->role == 'Admin' or $user->role == 'IT Head' or $user->role == 'IT test') {
            return view('admindashboard', compact(
                'lemburData',
                'lemburCount',
                'lemburCountP',
                'lemburCountR',
                'lemburCountS'
            ));
        } else {
            return view('dashboard', compact(
                'lemburData',
                'lemburCountUser',
                'lemburCountUS',
                'lemburCountUP',
                'lemburCountUR'
            ));
        }
    }

 
    /**
     * Menyimpan pengajuan lembur ke database.
     */
    public function crtlembur(Request $request)
{
    try {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_pulang' => 'required|date_format:H:i',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'jml_lembur' => 'required|numeric|min:0.1',
            'pekerjaan' => 'required|string|max:255',
            'hasil_lembur' => 'required|string|max:255',
            'upload_doc' => 'nullable|file|mimes:pdf,docx,jpg,png|max:2048',
            'lokasi' => 'required|string|max:255',
        ]);

        // Debug: Log Data Request
        Log::info('Data Pengajuan Lembur:', $request->all());

        // File upload handling
        $filePath = null;
        if ($request->hasFile('upload_doc')) {
            $file = $request->file('upload_doc');
            $filePath = $file->store('lembur_docs', 'public');
            Log::info('File berhasil diupload: ', ['path' => $filePath]);
            
        }

        // Update atau create data lembur
        $lembur = ListLembur::find($request->id); // Cek jika data ada
        if ($lembur) {
            $lembur->update([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'division' => $request->division,
                'tanggal' => $request->tanggal,
                'jam_masuk' => $request->jam_masuk,
                'jam_pulang' => $request->jam_pulang,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'jml_lembur' => $request->jml_lembur,
                'pekerjaan' => $request->pekerjaan,
                'hasil_lembur' => $request->hasil_lembur,
                'upload_doc' => $filePath ?? $lembur->upload_doc, // Hanya ganti file jika ada file baru
                'lokasi' => $request->lokasi,
            ]);
            Log::info('Lembur berhasil diupdate.');
        } else {
            ListLembur::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'division' => $request->division,
                'tanggal' => $request->tanggal,
                'jam_masuk' => $request->jam_masuk,
                'jam_pulang' => $request->jam_pulang,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'jml_lembur' => $request->jml_lembur,
                'pekerjaan' => $request->pekerjaan,
                'hasil_lembur' => $request->hasil_lembur,
                'upload_doc' => $filePath,
                'lokasi' => $request->lokasi,
                'status' => 'Pending', // Default status lembur baru
            ]);
            Log::info('Lembur baru berhasil disimpan.');
        }

        return redirect()->route('dashboard')->with('success', 'Pengajuan lembur berhasil disimpan!');
         
    } catch (\Exception $e) {
        Log::error('Error pengajuan lembur xx: ' . $e->getMessage());
       


        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}



    


}