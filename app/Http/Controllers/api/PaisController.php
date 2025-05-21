<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pais;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paises = DB::table('tb_pais')
            ->select('tb_pais.*')
            ->get();

        return json_encode(['paises' => $paises]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'pais_nomb' => ['required', 'max:255'],
                'pais_capi' => ['required', 'max:255'], // ✅ Agregado
            ]);

            $pais = new Pais();
            $pais->pais_codi = Str::upper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3));
            $pais->pais_nomb = $request->pais_nomb;
            $pais->pais_capi = $request->pais_capi;
            $pais->save();

            return response()->json(['pais' => $pais], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear el país.',
                'detalle' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pais = Pais::find($id);
        if (is_null($pais)) {
            return abort(404);
        }

        return json_encode(['pais' => $pais]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'pais_nomb' => ['required', 'max:255'],
        ]);

        $pais = Pais::find($id);
        if (is_null($pais)) {
            return response()->json(['message' => 'País no encontrado.'], 404);
        }

        $pais->pais_nomb = $request->pais_nomb;
        $pais->save();

        return response()->json(['pais' => $pais]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pais = Pais::find($id);
        if (is_null($pais)) {
            return abort(404);
        }

        $pais->delete();

        $paises = DB::table('tb_pais')
            ->select('tb_pais.*')
            ->get();

        return response()->json(['paises' => $paises, 'success' => true]);
    }
}
