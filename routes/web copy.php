<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CrtLemburController;
use App\Http\Controllers\DashboardController;


// Halaman utama
Route::get('/', function () {
    return view('display'); 
});

// Halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Halaman registrasi
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');



// Route untuk halaman dashboard user
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk halaman dashboard admin
Route::middleware('auth')->get('/admindashboard', [DashboardController::class, 'adminDashboard'])->name('admindashboard');


// Route untuk halaman dashboard admin dan user mengambil data lembur unutk tabel
Route::post('/crtlembur', [CrtLemburController::class, 'crtlembur'])->name('crtlembur');
Route::get('/dashboard', [CrtLemburController::class, 'showDataLemburForm'])->name('dashboard');
Route::get('/admindashboard', [CrtLemburController::class, 'showDataLemburForm'])->name('admindashboard');

// Route untuk approval dan reject 
Route::get('/approve-lembur/{id}', [CrtLemburController::class, 'approve'])->name('approveLembur');
Route::get('/reject-lembur/{id}', [CrtLemburController::class, 'reject'])->name('rejectLembur');
Route::get('/preview/{id}', [CrtLemburController::class, 'preview'])->name('privew');


// Halaman Profile user(dengan otentikasi)
Route::middleware('auth')->get('/profile', [ProfileController::class, 'showProfileForm'])->name('profile');
Route::middleware('auth')->get('/profileadmin', [ProfileController::class, 'showProfileAdminForm'])->name('profileadmin');

// Halaman  approval
Route::get('/approval', [CrtLemburController::class, 'showApprovalForm'])->name('approval');



 // Menampilkan halaman role
Route::get('/role', [RoleController::class, 'showRoleForm'])->name('role');
// Mengupdate role
Route::patch('/role/{id}', [RoleController::class, 'updateRole'])->name('update.role');


// Halaman Create Lembur (dengan otentikasi)
Route::middleware('auth')->get('/crtlembur', [CrtLemburController::class, 'showLemburForm'])->name('crtlembur');
Route::middleware('auth')->post('/crtlembur', [CrtLemburController::class, 'crtlembur'])->name('crtlembur');



// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
