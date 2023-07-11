<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $discipline=Discipline::all();

        return response()->json( $discipline);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $classe = Discipline::findOrFail($id);
        $discipline = Discipline::create([
            'libelle' => $request->input('libelle'),
            
        ]);
    
        // $classe->hackeuses()->save($hackeuse);

        return response()->json($discipline, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

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
