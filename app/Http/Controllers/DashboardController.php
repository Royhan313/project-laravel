<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListLembur;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk user biasa
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Menampilkan view dashboard untuk user biasa
        return view('dashboard'); // Anda bisa mengganti ini dengan tampilan untuk user biasa
    }

    /**
     * Menampilkan halaman dashboard untuk admin
     *
     * @return \Illuminate\View\View
     */
    public function adminDashboard()
    {
        // Menampilkan view dashboard khusus untuk admin
        return view('admindashboard'); // Pastikan Anda memiliki file view untuk admin
    }
}
