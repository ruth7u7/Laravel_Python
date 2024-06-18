<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function show()
    {
        try {

            $peli = Pelicula::findAll();
            return response()-> json($peli);

        } catch (\Exception $e) {
            
            return response()->json($e);
        }
        
    }

    public function get($idpelicula)
    {
        
        $pelis = Pelicula::where('id', $idpelicula)->first();

        if (!$pelis) {
            return response() -> json(404);
        }
        return response()-> json($pelis);

        // try {
        //     $peli=Pelicula::with('id', $idpelicula)->get();
        //     return response()->json($peli);
            
        // } catch (\Exception $e){
        //     return response()->json('Error, No se encontro el id',$e);
        // }

    }

    public function store(Request $request) 
    {
        $pelis = new Pelicula();
        $pelis -> Titulo = $request -> Titulo;
        $pelis -> FechaEstreno = $request -> FechaEstreno;

        if($pelis->save())
        {
            return response()->json($pelis);
        }

        return abort(402, "Error al insertar los datos");    
    }


}
