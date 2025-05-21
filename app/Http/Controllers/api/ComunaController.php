<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comuna;
use Illuminate\Support\Facades\DB;

class ComunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comunas = DB::table('tb_comuna')
        ->join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
        ->select('tb_comuna.*', "tb_municipio.muni_nomb")
        ->get();
        return json_encode(['comunas'=>$comunas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'comu_nomb' => ['required', 'max:255'],
                'muni_codi' => ['required', 'numeric', 'min:1'],
            ]);

            $comuna = new Comuna();
            $comuna->comu_nomb = $request->comu_nomb;
            $comuna->muni_codi = $request->muni_codi;
            $comuna->save();

            return response()->json(['comuna' => $comuna], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear la comuna.',
                'detalle' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comuna = Comuna::find($id);
        if (is_null($comuna)) {
            return abort(404);
        }
        $municipios = DB::table('tb_municipio')
            ->orderBy('muni_nomb')
            ->get();

        return json_encode(['comuna' => $comuna, 'municipios' => $municipios]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valida los datos; si hay errores, Laravel lanza una excepción automáticamente
        $request->validate([
            'comu_nomb' => ['required', 'max:255'],
            'muni_codi' => ['required', 'numeric', 'min:1'],
        ]);

        $comuna = Comuna::find($id);
        if (is_null($comuna)) {
            return response()->json(['message' => 'Comuna no encontrada.'], 404);
        }

        $comuna->comu_nomb = $request->comu_nomb;
        $comuna->muni_codi = $request->muni_codi;
        $comuna->save();

        return response()->json(['comuna' => $comuna]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comuna = Comuna::find($id);
        if (is_null($comuna)) {
            return abort(404);
        }
        $comuna->delete();
    
        $comunas = DB::table('tb_comuna')
            ->join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
            ->select('tb_comuna.*', 'tb_municipio.muni_nomb')
            ->get();
        return json_encode(['comunas' => $comunas, 'success' => true]);

    }
}
