<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\evento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\categoria;
use Carbon\Carbon;
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

    public function buscarFechaAdmin(Request $request)
    {
        $buscarFech = DB::table('eventos')->where('date', $request->input('date'))->get();
        return view('admin.dashboardAdmin', ['eventos' => $buscarFech, 'categorias' => categoria::all()]);
    }
    /**
     * Buscar por ciudad
     */
    public function buscarCiudadAdmin(Request $request)
    {
        $buscarCiu = DB::table('eventos')->where('city', $request->input('city'))->get();
        return view('admin.dashboardAdmin', ['eventos' => $buscarCiu, 'categorias' => categoria::all()]);
    }
    /**
     * Buscar por fecha
     */
    public function buscarCategoriaAdmin(Request $request)
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
     * Store a newly created resource in storage.
     */
    public function storeAPI(Request $request)
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

        return response()->json([
            'message' => 'Evento creado exitosamente',
            'data' => $evento
        ]);   
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
    
    public function eliminar(Evento $evento, User $user) {
        if ( $evento->users()->where('user_id', $user->id)->get()->count() == 1)
            $evento->users()->detach($user->id);

            return back();
    }
 //////////////////////////////////////////CREADOR//////////////////////////////////////////////////////
    //////////////////////////////////////////CREADOR//////////////////////////////////////////////////////
    //////////////////////////////////////////CREADOR//////////////////////////////////////////////////////
    public function indexCreadorEvento()
    {
        //
        return view('creadorEventos.creadorEventos', ['eventos' => evento::all(), 'categorias' => categoria::all()]);
    }
    //////////////////////////////////////////ASISTENTE//////////////////////////////////////////////////////
    //////////////////////////////////////////ASISTENTE//////////////////////////////////////////////////////
    //////////////////////////////////////////ASISTENTE//////////////////////////////////////////////////////

    public function indexAsistente()
    {
        //
        return view('asistente.dashboardAsistente', ['eventos' => evento::all(), 'categorias' => categoria::all()]);
    }
    //INFO
    public function infoEvento(evento $evento , user $user)
    {
        //
        return view('asistente.infoEvento', ['evento' => $evento, 'categorias' => categoria::all(), 'user' => $user,'usuarios' => $evento->users()->get()]);
    }
    /**
     * Buscar por fecha
     */
    public function buscarFecha(Request $request)
    {
        $buscarFech = DB::table('eventos')->where('date', $request->input('date'))->get();
        return view('asistente.dashboardAsistente', ['eventos' => $buscarFech, 'categorias' => categoria::all()]);
    }
    /**
     * Buscar por ciudad
     */
    public function buscarCiudad(Request $request)
    {
        $buscarCiu = DB::table('eventos')->where('city', $request->input('city'))->get();
        return view('asistente.dashboardAsistente', ['eventos' => $buscarCiu, 'categorias' => categoria::all()]);
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
        return view('asistente.dashboardAsistente', ['eventos' => $buscarCat, 'categorias' => categoria::all()]);
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
       
    }

    /**
     * Remove the specified resource from storage.
     */

    //MÉTODOS MANY TO MANY
    public function asistentes(Evento $evento, User $user)
    {
        return view('asistente.dashboard' , ['evento' => $evento, 'asistentes' => $user->users()->orderBy('name', 'asc')->get()]);
    }

    public function inscribir(Request $request)
    {
        $evento = new Evento();
        $user = new User();
        $evento->id = $request->input('evento_id');
        $user->id = $request->input('user_id');

        $numEntradas = $request->input('numEntradas');
        $estado = $request->input('estado');
        if ($evento->users()->where('user_id', $user->id)->get()->count() == 0) {
            $evento->users()->attach($user->id, ['numEntradas' => $numEntradas, 'estado' => $estado]);
        }

        return back();
    }

    public function desinscribir(Evento $evento, User $user) {
        if ( $evento->users()->where('user_id', $user->id)->get()->count() == 1)
            $evento->users()->detach($user->id);

            return back();
    }
}
