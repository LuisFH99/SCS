<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SoftwareController;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class);
Route::resource('softwares', SoftwareController::class);
Route::get('/softwares/{software}/tipo/{tipo}', [App\Http\Controllers\SoftwareController::class, 'edit1'])->name('softwares.edit1');

Route::get('/reportes', [App\Http\Controllers\HomeController::class, 'index1'])->name('reportes');
Route::post('/mostrarPDF', [App\Http\Controllers\HomeController::class, 'mostrarPDF'])->name('mostrarPDF');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Encargado
Route::view('home', 'livewire.entidades.index')->name('home');
Route::view('entidad/{id}', 'livewire.requerimiento.index')->name('requerimiento.index');
//admin
Route::view('entidades', 'livewire.admin.entidades.index')->name('admin.entidades.index');


