<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
    return redirect('data-sdi');
});

Auth::routes();

Route::get('/data-sdi', [App\Http\Controllers\SdiController::class, 'index'])->name('data-sdi')->middleware('auth');
Route::get('/data-sdi/hitung', [App\Http\Controllers\SdiController::class, 'hitungSdi'])->name('data-sdi.hitung')->middleware('auth');
Route::post('/data-sdi/hitung/save', [App\Http\Controllers\SdiController::class, 'saveStationing'])->name('data-sdi.hitung.save');

Route::get('/riwayat', [App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat')->middleware('auth');
Route::get('/ekspor', [App\Http\Controllers\EksporController::class, 'index'])->name('ekspor')->middleware('auth');

Route::get('logout', function (){
    auth()->logout();
    Session()->flush();
    return Redirect::to('/login');
})->name('logout');