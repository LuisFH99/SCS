<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\ReportesController;
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


Auth::routes(['register'=>false]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class)->middleware('can:admin.users.index');
Route::resource('softwares', SoftwareController::class)->middleware('can:admin.users.index');
Route::get('/softwares/{software}/tipo/{tipo}', [App\Http\Controllers\SoftwareController::class, 'edit1'])->middleware('can:admin.users.index')->name('softwares.edit1');

Route::get('/reportes', [App\Http\Controllers\HomeController::class, 'index1'])->middleware('can:admin.users.index')->name('reportes');
Route::post('/mostrarPDF', [App\Http\Controllers\HomeController::class, 'mostrarPDF'])->middleware('can:admin.users.index')->name('mostrarPDF');
Route::get('/sofwares', [ReportesController::class, 'ReportListSoftwares'])->middleware('can:admin.users.index')->name('ReportListSoftwares');
Route::middleware(['auth'])->group(function () {
    //Encargado
    Route::view('home', 'livewire.entidades.index')->name('home');
    Route::view('entidad/{id}', 'livewire.requerimiento.index')->name('requerimiento.index');
    //admin
    Route::view('entidades', 'livewire.admin.entidades.index')->middleware('can:admin.users.index')->name('admin.entidades.index');
});

