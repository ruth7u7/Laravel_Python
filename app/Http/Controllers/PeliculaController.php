<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function show()
    {
        try {

            $pelis = Pelicula::findAll();
            return response()-> json($pelis);

        } catch (\Exception $e) {
            
            return response()-> json($e);
        }
        
    }

    public function get($idpelicula)
    {
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
