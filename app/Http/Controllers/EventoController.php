<?php

namespace App\Http\Controllers;

use App\Models\evento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\categoria;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexWelcome()
    {
        //
        return view('welcome', ['eventos' => evento::all(), 'categorias' => categoria::all()]);
    }
    public function indexAdmin()
    {
        //
        return view('admin.dashboardAdmin', ['eventos' => evento::all(), 'categorias' => categoria::all()]);
    }
    /**
     * Buscar por fecha
     */

    public function buscarFecha(Request $request)
    {
        $buscarFech = DB::table('eventos')->where('date', $request->input('date'))->get();
        return view('admin.dashboardAdmin', ['eventos' => $buscarFech]);
    }
    /**
     * Buscar por ciudad
     */
    public function buscarCiudad(Request $request)
    {
        $buscarCiu = DB::table('eventos')->where('city', $request->input('city'))->get();
        return view('admin.dashboardAdmin', ['eventos' => $buscarCiu]);
    }
    /**
     * Buscar por fecha
     */
    public function buscarCategoria(Request $request)
    {

        $buscarCat = DB::table('eventos')
            ->join('categorias', 'eventos.categoria_id', '=', 'categorias.id')
            ->where('categorias.name', '=', $request->input('buscarCategoria'))
            ->select('eventos.*', 'categorias.name as categoria_name')
            ->get();
        return view('admin.dashboardAdmin', ['eventos' => $buscarCat, 'categorias' => categoria::all()]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.formNuevoEvento', ['eventos' => evento::all(), 'categorias' => categoria::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->flash();

        //Grabar un objeto evento en BBDD con los datos del $request
        $evento = new Evento();

        $evento->name = $request->input('name');
        $evento->date = $request->input('date');
        $evento->description = $request->input('description');
        $evento->city = $request->input('city');
        $evento->address = $request->input('address');
        $evento->aforomax = $request->input('aforomax');
        $evento->tipo = $request->input('tipo');
        $evento->numMaxEntradas = $request->input('numMaxEntradas');
        $evento->categoria_id = $request->input('categoria_id');
        $evento->user_id = $request->input('user_id');

        $evento->save();

        return view('admin.dashboardAdmin', ['eventos' => evento::all(), 'categorias' => categoria::all()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(evento $evento)
    {
        //
        return view('admin.infoEventos', ['evento' => $evento, 'asistentes' => $evento->users()->get()]);
    }
    public function destroy(evento $evento)
    {
        //
        $evento->delete();
        return view('admin.dashboardAdmin', ['eventos' => evento::all(), 'categorias' => categoria::all()]);
    }

    //////////////////////////////////////////ASISTENTE//////////////////////////////////////////////////////
    public function indexAsistente()
    {
        //
        return view('asistente.dashboardAsistente', ['eventos' => evento::all(), 'categorias' => categoria::all()]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */


    //MÉTODOS MANY TO MANY
    // public function asistentes(Evento $evento)
    // {
    //     return view('asistente.dashboard' , ['evento' => $evento, 'asistentes' => $grupo->componentes()->orderBy('name', 'asc')->get()]);
    // }

    // public function inscribir(Grupo $grupo, User $user) {
    //     if ( $grupo->componentes()->where('user_id', $user->id)->get()->count() == 0)
    //         $grupo->componentes()->attach($user->id, [ 'created_at' => Carbon::now()]);

    //     return view('web.grupocomponentes' , ['grupo' => $grupo, 'componentes' => $grupo->componentes()->orderBy('name', 'asc')->get()]);
    // }

    // public function desinscribir(Grupo $grupo, User $user) {
    //     if ( $grupo->componentes()->where('user_id', $user->id)->get()->count() == 1)
    //         $grupo->componentes()->detach($user->id);

    //     return view('web.grupocomponentes' , ['grupo' => $grupo, 'componentes' => $grupo->componentes()->orderBy('name', 'asc')->get()]);
    // }
}
