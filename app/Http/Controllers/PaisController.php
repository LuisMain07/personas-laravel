<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paises = DB::table('tb_pais')->orderBy('pais_nomb')->get();
        return view('pais.index', ['paises' => $paises]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pais.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pais = new Pais();
        $pais->pais_codi = $request->code;
        $pais->pais_nomb = $request->name;
        $pais->pais_capi = $request->capital;
        $pais->save();

        return redirect()->route('paises.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pais = Pais::find($id);
        return view('pais.edit', ['pais' => $pais]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pais = Pais::find($id);
        $pais->pais_nomb = $request->name;
        $pais->pais_capi = $request->capital;
        $pais->save();

        return redirect()->route('paises.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pais = Pais::find($id);
        $pais->delete();

        return redirect()->route('paises.index');
    }
}
