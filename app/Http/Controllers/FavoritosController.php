<?php

namespace App\Http\Controllers;

use App\Models\Favoritos;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = auth()->user()->id;
        $bus = DB::select("SELECT * FROM peliculas, favoritos WHERE peliculas.id = favoritos.idpelicula AND favoritos.idusuario = ".$id);
        $data = [
            'mensaje' => 'Eliminado',
            'result' => $bus,
            'status' => 'OK',
        ];
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    
    public function borrar(Request $request)
    {
        $id = auth()->user()->id;
        Favoritos::where(['idpelicula' => $request->id, 'idusuario' => $id])->delete();
        $data = [
            'mensaje' => 'Eliminado',
            'result' => 'Correcto',
            'status' => 'OK',
        ];
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $id = auth()->user()->id;
        $bus = Pelicula::where(['imdbID' => $request->imdbID])->first();
        if (!$bus) {
            $pelicula = new Pelicula();
            $pelicula->imdbID = $request->imdbID;
            $pelicula->Title = $request->Title;
            $pelicula->Year = $request->Year;
            $pelicula->Actors = $request->Actors;
            $pelicula->Director = $request->Director;
            $pelicula->Poster = $request->Poster;
            $pelicula->save();
        }

        $favoritos = new Favoritos();
        if ($bus) {
            $favoritos->idpelicula = $bus->id;
        }else{
            $favoritos->idpelicula = $pelicula->id;
        }
        $favoritos->idusuario = $id;
        $bus = Favoritos::where(['imdbID' => $request->imdbID, 'idusuario' => $id]);
        if(!$bus){
            $favoritos->save();
        }       
        $data = [
            'mensaje' => 'Registrado con exito',
            'result' => 'Correcto',
            'status' => 'OK',
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Favoritos $favoritos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favoritos $favoritos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favoritos $favoritos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favoritos $favoritos)
    {
        //
    }
}
