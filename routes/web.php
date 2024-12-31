<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\DataLebahController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/datalebah',[DataLebahController::class, 'index'])->name('datalebah');

Route::get('/tambahdatalebah',[DataLebahController::class, 'create'])->name('tambahdatalebah');
Route::post('/insertdata',[DataLebahController::class, 'insert'])->name('insertdata');

Route::get('/tampildata/{id}',[DataLebahController::class, 'tampildata'])->name('tampildata');
Route::post('/ubahdata/{id}',[DataLebahController::class, 'update'])->name('ubahdata');

Route::get('/hapusdata/{id}',[DataLebahController::class, 'delete'])->name('hapusdata');

Route::get('/rinciandata/{id}',[DataLebahController::class, 'read'])->name('rinciandata');

Route::get('/grafik', [GrafikController::class, 'index'])->name('grafik');
Route::post('/tambahdatapanen', [GrafikController::class, 'tambahDataPanen']);//
Route::get('/tampildatapanen/{id}', [GrafikController::class, 'tampilDataPanen']);//
Route::post('/ubahdatapanen/{id}', [GrafikController::class, 'ubahDataPanen']);//
Route::get('/hapusdatapanen/{id}', [GrafikController::class, 'hapusDataPanen']);//
