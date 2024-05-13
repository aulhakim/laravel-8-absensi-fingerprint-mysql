<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\NotifikasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
Route::get('/create-user', [DashboardController::class, 'createUserForm'])->name('create-user');
Route::post('/store-user', [DashboardController::class, 'storeUser'])->name('store-user');

Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
Route::get('/absensi/kirim-surat', [AbsensiController::class, 'kirimSurat'])->name('absensi.kirim-surat');
Route::post('/absensi/kirim-surat', [AbsensiController::class, 'kirimSurat'])->name('absensi.kirim-surat');
Route::get('/absensi/sync-data-absensi', [AbsensiController::class, 'syncData'])->name('sync-absensi');
Route::get('/absensi/download', [AbsensiController::class, 'downloadAbsensi'])->name('download.absensi');

Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');


Route::get('user/guru', [UsersController::class, 'guru'])->name('user.guru');
Route::get('user/guru/add', [UsersController::class, 'addGuru'])->name('user.guru.add');
Route::post('user/guru/store', [UsersController::class, 'storeGuru'])->name('user.guru.store');
Route::get('user/guru/edit/{id}', [UsersController::class, 'editGuru'])->name('user.guru.edit');
Route::get('user/guru/view/{id}', [UsersController::class, 'editGuru'])->name('user.guru.view');
Route::get('user/guru/delete/{id}', [UsersController::class, 'deleteGuru'])->name('user.guru.delete');


Route::get('user/murid', [UsersController::class, 'murid'])->name('user.murid');
Route::get('user/murid/add', [UsersController::class, 'addMurid'])->name('user.murid.add');
Route::post('user/murid/store', [UsersController::class, 'storeMurid'])->name('user.murid.store');
Route::get('user/murid/edit/{id}', [UsersController::class, 'editMurid'])->name('user.murid.edit');
Route::get('user/murid/delete/{id}', [UsersController::class, 'deleteMurid'])->name('user.murid.delete');


Route::get('user/orang-tua', [UsersController::class, 'orangTua'])->name('user.orangtua');
Route::get('user/orang-tua/add', [UsersController::class, 'addOrangTua'])->name('user.orang-tua.add');
Route::post('user/orang-tua/store', [UsersController::class, 'storeOrangTua'])->name('user.orang-tua.store');
Route::get('user/orang-tua/edit/{id}', [UsersController::class, 'editOrangTua'])->name('user.orang-tua.edit');
Route::get('user/orang-tua/delete/{id}', [UsersController::class, 'deleteOrangTua'])->name('user.orang-tua.delete');

Route::get('master/kelas', [MasterController::class, 'kelas'])->name('master.kelas');
Route::get('user/kelas/add', [MasterController::class, 'addKelas'])->name('user.kelas.add');
Route::post('user/kelas/store', [MasterController::class, 'storeKelas'])->name('user.kelas.store');
Route::get('user/kelas/edit/{id}', [MasterController::class, 'editKelas'])->name('user.kelas.edit');
Route::get('user/kelas/delete/{id}', [MasterController::class, 'deleteKelas'])->name('user.kelas.delete');
