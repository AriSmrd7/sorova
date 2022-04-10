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
    return redirect('data-primer');
});

Auth::routes();

Route::get('/data-primer', [App\Http\Controllers\SdiController::class, 'index'])->name('data-primer')->middleware('auth');
Route::post('/data-primer/insert', [App\Http\Controllers\SdiController::class, 'saveData'])->name('data-primer.insert')->middleware('auth');

Route::get('/data-primer/{id}/sdi-count', [App\Http\Controllers\SdiController::class, 'hitungSdi'])->name('data-primer.sdi.index')->middleware('auth');
Route::post('/data-primer/sdi-count/save', [App\Http\Controllers\SdiController::class, 'saveStationing'])->name('data-primer.sdi.save');
Route::get('/data-primer/{id}/sdi-result', [App\Http\Controllers\ResultController::class, 'index'])->name('data-primer.sdi.result')->middleware('auth');


Route::get('/riwayat', [App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat')->middleware('auth');
Route::get('/ekspor', [App\Http\Controllers\EksporController::class, 'index'])->name('ekspor')->middleware('auth');

Route::get('logout', function (){
    auth()->logout();
    Session()->flush();
    return Redirect::to('/login');
})->name('logout');

Route::get('/truncate', [App\Http\Controllers\TruncateTable::class, 'index'])->name('truncate.table')->middleware('auth');
