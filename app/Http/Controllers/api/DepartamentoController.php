<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamento;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos = DB::table('tb_departamento')
        ->join('tb_pais', 'tb_departamento.pais_codi', '=', 'tb_pais.pais_codi')
        ->select('tb_departamento.*', 'tb_pais.pais_nomb')
        ->get();
    
         return json_encode(['departamentos' => $departamentos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'depa_nomb' => ['required', 'max:255'],
                'pais_codi' => ['required', 'min:1'],
            ]);

            $departamento = new Departamento();
            $departamento->depa_nomb = $request->depa_nomb;
            $departamento->pais_codi = $request->pais_codi;
            $departamento->save();

            return response()->json(['departamento' => $departamento], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear el departamento.',
                'detalle' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $departamento = Departamento::find($id);
        if (is_null($departamento)) {
                return abort(404);
            }
        $paises = DB::table('tb_pais')
            ->orderBy('pais_nomb')
            ->get();
    
        return json_encode(['departamento' => $departamento, 'paises' => $paises]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'depa_nomb' => ['required', 'max:255'],
            'pais_codi' => ['required', 'min:1'],
        ]);

        $departamento = Departamento::find($id);
        if (is_null($departamento)) {
            return response()->json(['message' => 'Departamento no encontrado.'], 404);
        }

        $departamento->depa_nomb = $request->depa_nomb;
        $departamento->pais_codi = $request->pais_codi;
        $departamento->save();

        return response()->json(['departamento' => $departamento]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departamento = Departamento::find($id);
        $departamento->delete();
    
        $departamentos = DB::table('tb_departamento')
            ->join('tb_pais', 'tb_departamento.pais_codi', '=', 'tb_pais.pais_codi')
            ->select('tb_departamento.*', 'tb_pais.pais_nomb')
            ->get();
    
        return json_encode(['departamentos' => $departamentos, 'success' => true]);
    }
}
