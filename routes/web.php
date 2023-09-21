<?php

use App\Http\Controllers\CaracteristicaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\DomoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\MetodoController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function(){ 
    route::resource('roles', RolController::class); 
    route::resource('usuarios', UsuarioController::class); 
    route::resource('clientes', ClienteController::class);
    route::resource('reservas', ReservaController::class);
    route::resource('domos', DomoController::class);
    route::resource('servicios', ServicioController::class);
    route::resource('caracteristicas', CaracteristicaController::class);
    route::resource('metodos', MetodoController::class);

});
Route::post('/domos/guardarCaracteristicas', 'DomoController@guardarCaracteristicas')->name('domos.guardarCaracteristicas');
Route::post('/domos/{domo}', 'DomoController@update')->name('domos.update');
Route::delete('/usuarios/{id}', 'UserController@destroy')->name('usuarios.destroy');
//Route::get('reserva/{id}/pdf', 'ReservaController@generatePDF')->name('reserva.pdf');
Route::post('/reservas/guardarServicios', 'ReservaController@guardarServicios')->name('reservas.guardarServicios');
Route::post('/reservas/{reserva}', 'ReservaController@update')->name('reservas.update');
Route::get('/reserva/{id}/pdf', [ReservaController::class, 'generatePDF'])->name('reserva.pdf');
Route::view('/ayuda', 'ayuda.ayuda');





