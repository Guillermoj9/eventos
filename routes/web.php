<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard',[EventoController::class,'indexAdmin'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/eventos/{evento}/destroy',[EventoController::class,'destroy']);
    Route::get('/eventos/{evento}/show' , [EventoController::class, 'show']);
    
    Route::get('/eventos/nuevo' , [EventoController::class, 'create']);
    Route::post('/eventos/guardar' , [EventoController::class, 'store']);

    Route::post('/eventos/buscarFecha' , [EventoController::class, 'buscarFecha']);
    Route::post('/eventos/buscarCiudad' , [EventoController::class, 'buscarCiudad']);
    Route::post('/eventos/buscarCategoria' , [EventoController::class, 'buscarCategoria']);
});
Route::get('/',[EventoController::class,'indexWelcome']);

require __DIR__.'/auth.php';
