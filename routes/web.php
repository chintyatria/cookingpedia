<?php

use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminKategoriController; 
use App\Http\Controllers\DashboardResepController;

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

Route::get('/', function () {
    return view('beranda', [
        "title" => "Beranda",
        "active" => "beranda"
    ]);
});

Route::get('/tulis_resep', function() {
    return view('tulis_resep', [
        "title" => "Tulis Resep",
        "active" => "tulis resep"
    ]);
});



Route::get('/reseps', [ResepController::class, 'index']);
Route::get('/reseps/{resep:slug}', [ResepController::class, 'show']);

Route::get('/kategoris', function(){
    return view('kategoris', [
        'title' => 'Kategori Masakan',
        'active' =>'kategoris',
        'kategoris' => Kategori::all()
    ]);
});



Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth');

Route::get('/dashboard/reseps/cekSlug', [DashboardResepController::class ,'cekSlug'])->middleware('auth');
Route::resource('/dashboard/reseps', DashboardResepController::class)->middleware('auth');

Route::resource('/dashboard/kategoris', AdminKategoriController::class)->except('show')->middleware('admin');

// Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {