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

// Route::get('/permisos', function () {
//     $role1 = Role::create(['name' => 'SuperAdmin']);
//     $role2 = Role::create(['name' => 'Admin']);
//     $role3 = Role::create(['name' => 'Encargado']);

//     Permission::create(['name'=>'admin.home'])->syncRoles([$role1,$role2,$role3]);

//     Permission::create(['name'=>'admin.users.index'])->syncRoles([$role1,$role2]);
//     Permission::create(['name'=>'admin.users.edit'])->syncRoles([$role1,$role2]);
//     Permission::create(['name'=>'admin.users.update'])->syncRoles([$role1,$role2]);

//     Permission::create(['name'=>'encargado.software.index'])->syncRoles([$role1,$role3]);
//     Permission::create(['name'=>'encargado.software.edit'])->syncRoles([$role1,$role3]);
//     Permission::create(['name'=>'encargado.software.update'])->syncRoles([$role1,$role3]);
//     auth()->user()->assignRole('Admin');
//     return 'sirvió';
// });

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class);
Route::resource('softwares', SoftwareController::class);
Route::get('/softwares/{software}/tipo/{tipo}', [App\Http\Controllers\SoftwareController::class, 'edit1'])->name('softwares.edit1');

Route::get('/reportes', [App\Http\Controllers\HomeController::class, 'index1'])->name('reportes');
Route::get('/mostrarPDF/{id}', [App\Http\Controllers\HomeController::class, 'mostrarPDF'])->name('mostrarPDF');
Route::get('/sofwares', [ReportesController::class, 'ReportListSoftwares'])->name('ReportListSoftwares');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Encargado
Route::view('home', 'livewire.entidades.index')->name('home');
Route::view('entidad/{id}', 'livewire.requerimiento.index')->name('requerimiento.index');
//admin
Route::view('entidades', 'livewire.admin.entidades.index')->name('admin.entidades.index');
Route::post('/users/habilitar', [UserController::class, 'habilitar'])->name('users.habilitar');

