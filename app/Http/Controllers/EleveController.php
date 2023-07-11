<?php

namespace App\Http\Controllers;
use App\Models\Eleve;
use App\Models\Annee;
use Illuminate\Http\Request;
use App\Models\Niveau;
use App\Models\Inscription;
use App\Http\Resources\InscriptionResource;


class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validez les données du formulaire
        $request->validate([
            'datenaissance' => 'date|before_or_equal:'.now()->subYear(5)->format('Y-m-d'),
        ]);
    
        // Générez le numéro de l'élève
        // $etat = $request->input('etat');
        $profil = $request->input('profil');
        $numero = null;
        
        if ($profil == 0) {
            $numero = Eleve::getNumeroEleve();
        }
        
        // $numero = Eleve::getNumeroEleve();
    var_dump($numero);
        // Créez un nouvel élève
        $eleve = Eleve::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'datenaissance' => $request->input('datenaissance'),
            'lieu' => $request->input('lieu'),
            'sexe' => $request->input('sexe'),
            'profil' => $request->input('profil'),
            'numero' => $numero,
            "email"=>$request->input('email')
            // Autres champs de l'élève
        ]);
        
    
        $annee = Annee::where('statut', 1)->first();
    
        // Créez une nouvelle inscription
        $inscription = Inscription::create([
            'eleve_id' => $eleve->id,
            'classe_id' => $request->input('classe_id'),
            'annee_id' => $annee->id,
            // Autres champs de l'inscription
        ]);
    
        // return $inscription;
        $inscription->load("classe");
        return new InscriptionResource($inscription);
    
        // Redirigez ou affichez un message de succès
    }
    
    
//     public function store(Request $request)
//     {
//         //
//         $eleve = Eleve::create([

//             'nom'=>'SY',
//             'prenom'=>'BABACAR',
//             'datenaissance'=>'2008-03-12',
//             'lieu'=>'Dakar',
//              'sexe'=>'M',
//              'profil'=>1
   
// ]);
//     return response()->json($eleve);
        
    
//     }

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
    public function create()
{
    $niveaux = Niveau::all(); // Récupérez tous les niveaux depuis le modèle Niveau

    return view('eleve.create', compact('niveaux'));
}


public function sortie(Request $request)
{
    
     $ids = $request->input('id');
  Eleve::whereIn('id',$ids)->update(['etat'=>0]);
  
    
//     if (!$ids) {
//         return response()->json(['message' => 'ID de l\'élève existe pas.'], 400);
//     }

//     $eleve = Eleve::findOrFail($ids);

    

// //    ->where('etat', 1)
//     if ($eleve->etat == 0) {
//         return response()->json(['message' => 'L\'élève est déjà sorti.'], 400);
//     }

   
//     $eleve->etat = 0;
//     $eleve->save();

    return response()->json(['message' => 'L\'élève est sorti avec succès.']);
}


}


