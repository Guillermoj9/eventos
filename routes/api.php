<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\evento;
use App\Models\categoria;
use App\Models\User;
use App\Http\Resources\EventoResource;
use App\Http\Resources\CategoriaResource;
use App\Http\Resources\AsistenteResource;
use App\Http\Resources\UserResource;
use App\Http\Controllers\EventoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Todos los eventos 
Route::get('eventia/eventos', function () {
    return new EventoResource(evento::all());
});

//Eventos por id 
Route::get('/eventia/eventosInfo/{id}', function ($id) {
    return new EventoResource(evento::findOrFail($id));
});
//Todos las categorias 
Route::get('/eventia/categorias', function () {
    return new CategoriaResource(Categoria::all());
});
//Asistente por dni
Route::get('/eventia/asistente/{dni}',  function ($dni) {
    return new UserResource(User::where("dni", $dni)->get());
});
//Asistente por dni y inscripcion
Route::get('/eventia/evento/inscripciones',  function ($dni) {
    return new UserResource(User::where("dni", $dni)->get());
});
//Crear evento
Route::put('/eventia/evento/nuevo', 'EventoController@storeAPI');

