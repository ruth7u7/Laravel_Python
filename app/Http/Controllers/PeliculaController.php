<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="APIs de Películas",
 *     version="1.0.0",
 *     description="Esta es la documentación de la APIs de Películas",
 *     @OA\Server(
 *         url="http://127.0.0.1:8000"
 *     )
 * )
 */

class PeliculaController extends Controller
{
    public function show()
    {
        try {

            $peli = Pelicula::All();
            return response()-> json($peli);

        } catch (\Exception $e) {
            
            return response()->json($e);
        }
        
    }

/**
 * @OA\Get(
 *     path="/api/get/{idpelicula}",
 *     summary="Obtener una película por ID",
 *     tags={"Películas"},
 *     @OA\Parameter(
 *         name="idpelicula",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Película encontrada",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Titulo", type="char", example="Jumanji: En la Selva (Todo Público)"),
 *             @OA\Property(property="FechaEstreno", type="date", format="date", example="2018-01-11"),
 *             @OA\Property(property="Director", type="char", example="Jake Kasdan"),
 *             @OA\Property(property="Generos", type="char", example="3,9"),
 *             @OA\Property(property="idClasificacion", type="integer", example=1),
 *             @OA\Property(property="idEstado", type="integer", example=1),
 *             @OA\Property(property="Duracion", type="char", example="120"),
 *             @OA\Property(property="Link", type="char", example="6maujJFcuxA"),
 *             @OA\Property(property="Reparto", type="text", example="Dwayne Johnson, Kevin Hart, Jack Black, Karen Gillan"),
 *             @OA\Property(property="Sinopsis", type="text", example="Remake de la película homónima de 1995 adaptado a la época actual,
 *             en donde cuatro adolescentes se introducen en un nueva aventura a partir de “Jumanji”, un videojuego que sirve como un portal a través
 *             del espacio-tiempo. Absorbidos por el mundo de Jumanji, este juego no se puede abandonar hasta que acaba la partida")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Película no encontrada",
 *         @OA\JsonContent(type="integer", example=404)
 *     )
 * )
 */

public function get($idpelicula)
{
    $pelis = Pelicula::where('n_id_pelicula', $idpelicula)->first();

    if (!$pelis) {
        return response()->json(404);
    }
    return response()->json($pelis);
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
