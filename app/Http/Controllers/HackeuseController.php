<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreeRequet;
use App\Models\Hackeuse;
use Illuminate\Http\Request;
use App\Models\Classe;

class HackeuseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreeRequet $request,$id)
    {
        $classe = Classe::findOrFail($id);
        $hackeuse = Hackeuse::create([
            'notemax' => $request->input('notemax'),
            'classe_id' => $request->input('classe_id'),
            'annee_id' => $request->input('annee_id'),
            'discipline_id' => $request->input('discipline_id'),
            'evaluation_id' => $request->input('evaluation_id'),
        ]);
    
        $classe->hackeuses()->save($hackeuse);

        return response()->json($hackeuse, 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $classes = Classe::join('hackeuses', 'classes.id', '=', 'hackeuses.classe_id')
                ->join('disciplines', 'hackeuses.discipline_id', '=', 'disciplines.id')
                ->join('evaluations', 'hackeuses.evaluation_id', '=', 'evaluations.id')
                ->where('classes.id', $id)
                ->select('classes.nom', 'disciplines.libelle as discipline','evaluations.libelle')
                ->get();

    
    return response()->json( $classes);

// return $classes;
        // $classe = Classe::findOrFail($id);
        // $hackeuses = $classe->hackeuses;
    
        // return response()->json($hackeuses);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
