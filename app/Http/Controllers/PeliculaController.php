<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Carbon\Carbon;
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

            $peli = Pelicula::all();
            return response()->json($peli, 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => 'Error al obtener las películas',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/get/{n_id_pelicula}",
     *     summary="Obtener una película por ID",
     *     tags={"Película"},
     *     @OA\Parameter(
     *         name="n_id_pelicula",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Película encontrada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="n_id_pelicula", type="unsignedBigInteger", example=1),
     *             @OA\Property(property="v_titulo", type="string", example="Jumanji: En la Selva (Todo Público)"),
     *             @OA\Property(property="d_fechaestreno", type="date", format="date", example="2018-01-11"),
     *             @OA\Property(property="v_director", type="string", example="Jake Kasdan"),
     *             @OA\Property(property="n_id_clasificacion", type="integer", example=1),
     *             @OA\Property(property="n_id_estado", type="unsignedBigInteger", example=1),
     *             @OA\Property(property="n_duracion", type="unsignedBigInteger", example="120"),
     *             @OA\Property(property="v_link", type="string", example="6maujJFcuxA"),
     *             @OA\Property(property="v_reparto", type="string", example="Dwayne Johnson, Kevin Hart, Jack Black, Karen Gillan"),
     *             @OA\Property(property="v_sinopsis", type="string", example="Remake de la película homónima de 1995 adaptado a la época actual,
     *             en donde cuatro adolescentes se introducen en un nueva aventura a partir de “Jumanji”, un videojuego que sirve como un portal a través
     *             del espacio-tiempo. Absorbidos por el mundo de Jumanji, este juego no se puede abandonar hasta que acaba la partida")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ocurrio un error al obtener los datos de la pelicula",
     *         @OA\JsonContent(type="integer", example=404)
     *     )
     * )
     */

    public function get($n_id_pelicula)
    {

        $pelis = Pelicula::where('n_id_pelicula', $n_id_pelicula,)->first();

        if (!$pelis) {
            return response()->json(['error'=>'Ocurrio un error al obtener los datos de la pelicula'], 404);
        }
        
        return response()->json($pelis);
    }

    public function store(Request $request)
    {
        $pelis = new Pelicula();
        $pelis->Titulo = $request->Titulo;
        $pelis->FechaEstreno = $request->FechaEstreno;

        if ($pelis->save()) {
            return response()->json($pelis);
        }

        return abort(402, "Error al insertar los datos");
    }
}
