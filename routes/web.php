<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('mahasiswas', MahasiswaController::class);
Route::get('mahasiswas/nilai/{Nim}', 'App\Http\Controllers\MahasiswaController@nilai')->name('mahasiswas.nilai');
Route::get('/cetak/{Nim}', 'App\Http\Controllers\MahasiswaController@cetak')->name('mahasiswa.cetak');

