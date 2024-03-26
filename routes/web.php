<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| Auth::routes();
|
*/

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function() {
    //Panel
    Route::get('/', App\Http\Livewire\Home\Index::class)->name('home');

    //Dispositivos
    Route::get('/dispositivos', App\Http\Livewire\Dispositivo\Index::class)->name('dispositivos');
    Route::get('/dispositivos/show/{id}', App\Http\Livewire\Dispositivo\Show::class)->name('dispositivos.show');
    Route::group(['middleware' => ['role:administrador']], function () {
        Route::get('/dispositivos/create', App\Http\Livewire\Dispositivo\Create::class)->name('dispositivos.create');
        Route::get('/dispositivos/edit/{id}', App\Http\Livewire\Dispositivo\Edit::class)->name('dispositivos.edit');
    });
    Route::get('/dispositivos/favorito', App\Http\Livewire\Dispositivo\Favorito::class)->name('dispositivos.favorito');
    Route::get('/dispositivos/categoria', App\Http\Livewire\Dispositivo\Categoria::class)->name('dispositivos.categoria');

    Route::group(['middleware' => ['role:administrador']], function () {
        //Plantillas
        Route::get('/plantillas/{view?}', App\Http\Livewire\Plantilla\PlantillaComponent::class)->name('plantillas');
        Route::get('/plantillas/show/{id?}', App\Http\Livewire\Plantilla\PlantillaOidComponent::class)->name('plantillas.show');

        //Sistema
        Route::get('/sistema/iniciar', [App\Http\Controllers\Sistema\SistemaController::class, 'iniciar'])->name('sistema.iniciar');
        Route::get('/sistema/detener', [App\Http\Controllers\Sistema\SistemaController::class, 'detener'])->name('sistema.detener');
        Route::get('/sistema/logs', App\Http\Livewire\Sistema\Logs::class)->name('sistema.logs');
    });

    //Alarmas
    Route::get('/alarmas', App\Http\Livewire\Alarmas\Index::class)->name('alarmas');
    Route::get('/alarmas/advertencia', App\Http\Livewire\Alarmas\Advertencia::class)->name('alarmas.advertencia');
    Route::get('/alarmas/dispositivo', App\Http\Livewire\Alarmas\Dispositivo::class)->name('alarmas.dispositivo');
    Route::get('/alarmas/error', App\Http\Livewire\Alarmas\Error::class)->name('alarmas.error');
    Route::get('/alarmas/satisfactorio', App\Http\Livewire\Alarmas\Satisfactorio::class)->name('alarmas.satisfactorio');

    //Usuario
    Route::group(['middleware' => ['role:administrador']], function () {
        Route::get('/usuarios', App\Http\Livewire\Usuario\Index::class)->name('usuario.index');
        Route::get('/usuario/create', App\Http\Livewire\Usuario\Create::class)->name('usuario.create');
        Route::get('/usuario/edit/{id}', App\Http\Livewire\Usuario\Edit::class)->name('usuario.edit');
    });
    Route::get('/usuario/perfil/{id}', App\Http\Livewire\Usuario\Perfil::class)->name('usuario.perfil');

    //Datos Equipos
    Route::get('/result', [App\Http\Controllers\GetDatosController::class, 'index']);

    Route::get('/notas/index', App\Http\Livewire\Notas\Index::class)->name('nota.index');
    Route::post('/notas/create', [App\Http\Livewire\Notas\Create::class, 'save'])->name('nota.create');
});
