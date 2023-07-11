<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvenementRequest;
use App\Http\Requests\UpdateEvenementRequest;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $evenement= Evenement::all();
       return response()->json( $evenement);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
    $this->validate($request, [
        'user_id' => 'exists:users,id' // Vérifie que user_id existe dans la table users
    ]);

    $evenement = Evenement::create($request->all());

    return response()->json(['message' => 'Événement créé avec succès', 'evenement' => $evenement], 201);
} catch(\Illuminate\Validation\ValidationException $e) {
    
    return response()->json([
        'error' => 'L\'utilisateur est invalide.'
    ], 400);

}
}


    /**
     * Display the specified resource.
     */
    public function show(Evenement $evenement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evenement $evenement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvenementRequest $request, Evenement $evenement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evenement $evenement)
    {
        //
    }
    function getParticipants($evenement_id){

        $particpants = DB::table('inscriptions')
           ->join('even_classes', 'even_classes.classe_id', '=', 'inscriptions.classe_id')
           ->where('even_classes.evenement_id', $evenement_id)
           ->select('inscriptions.eleve_id')
           ->get();
        return response()->json($particpants);
     }
     function addParticipants($evenement_id){
        // On parcours chaque classe sélectionnée
$classeIds = explode(',', request()->input('classe_ids'));

   // Supprimer les espaces
   $classeIds = array_map('trim', $classeIds);
        foreach($classeIds as $classe_id){
     
           // On insère un enregistrement dans la table even_classe
           DB::table('even_classes')->insert([
              'evenement_id' => $evenement_id,
              'classe_id' => $classe_id
           ]);
        }
     }
    

}
