<?php

namespace App\Http\Controllers;
use App\Traits\JoinQueryParams;
use App\Models\Inscription;
use App\Models\Classe;
use App\Models\Valeurs;
use App\Models\Discipline;
use App\Models\Evaluation;
use App\Models\ClassSemestre;
use App\Models\Hackeuse;
use Illuminate\Http\Request;
use App\Models\Niveau;
use App\Models\Notes;
use App\Http\Resources\NoteResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Optional;




class ClasseController extends Controller
{
    use JoinQueryParams;

    public function index()
    {
        //
        $classe=Classe::all();

        return response()->json( $classe);
    }
    public function store(Request $request)
    {
        //
        // $classe = Discipline::findOrFail($id);
        $classe = Classe::create([
            'nom' => $request->input('nom'),
            'niveau_id' => $request->input('niveau_id'),
            
        ]);
    
        // $classe->hackeuses()->save($hackeuse);

        return response()->json($classe, 201);
    }
    public function getClassesByNiveau($niveauId)
    {
        $niveau = Niveau::findOrFail($niveauId);
        $classes = $niveau->classes;
    
        return response()->json($classes);
    }
    public function getClassesByNiveaus($niveauId)
    {
        $classes = Classe::where('niveau_id', $niveauId)->get();

        return response()->json($classes);
    }
    
    
    // ...
    
    
// ...

public function checkNoteExists($inscriptionId,$hackeuseid)
{
    $existingNote = Notes::where('inscription_id', $inscriptionId)
    ->where('hackeuse_id',$hackeuseid)
    ->first();

    if ($existingNote) {
        return true; // Une note existe déjà pour cette inscription
    }

    return false; // Aucune note existante pour cette inscription
}

public function AjoutNote(Request $request, $classeId, $discId, $evaId)
{
    $notes = $request->all();
    $resultArray = [];
    $invalidNotes = [];

    foreach ($notes as $note) {
        $eleveId = $note['eleve_id'];
        $noteEleve = $note['note'];
        $result = $this->getInscriptionAndClasse($eleveId);
        $inscriptionId = $result->inscription_id;

        $ponderation = Hackeuse::where('classe_id', $classeId)
            ->where('discipline_id', $discId)
            ->where('evaluation_id', $evaId)
            ->select('hackeuses.id as id', 'hackeuses.noteMax as maxNotes')
            ->first();

        if ($ponderation) {
            $pond = $ponderation->id;
            $maxNote = $ponderation->maxNotes;

            $semestre = ClassSemestre::where('classe_id', $classeId)
                ->select('class_semestres.id as id')
                ->first();
            $semestreActif = $semestre->id;

            if ($this->checkNoteExists($inscriptionId, $pond)) {
                // Une note existe déjà pour cette inscription et cette hackeuse, vous pouvez choisir de la mettre à jour ou d'ignorer l'insertion
            } else {
                if ($noteEleve >= 0 && $noteEleve <= $maxNote) {
                    $resultArray[] = Notes::create([
                        'note' => $noteEleve,
                        'inscription_id' => $inscriptionId,
                        'hackeuse_id' => $pond,
                        'class_semestre_id' => $semestreActif
                    ]);
                } else {
                    $invalidNotes[] = [
                        'eleve_id' => $eleveId,
                        'note' => $noteEleve,
                    ];
                }
            }
        } else {
            return response()->json(['message' => 'Aucune pondération trouvée'], 404);
        }
    }

    if (!empty($invalidNotes)) {
        return response()->json([
            'message' => 'Certaines notes sont invalides',
            'invalid_notes' => $invalidNotes,
        ], 400);
    }

    return response()->json(['notes' => $resultArray]);
}


    public function getInscriptionAndClasse($eleveId)
    {
        $result = DB::table('eleves')
            ->join('inscriptions', 'eleves.id', '=', 'inscriptions.eleve_id')
            ->join('classes', 'inscriptions.classe_id', '=', 'classes.id')
            ->where('eleves.id', $eleveId)
            ->select('inscriptions.*', 'inscriptions.id as inscription_id',
            'classes.id as classe_id', 'eleves.nom as nom', 'eleves.prenom as prenom')
            ->first();

        return $result;
    }
      // Récupérez les données de la requête
           public function updateNote(Request $request, $classeId, $disciplineId, $evaluationId, $eleveId)
        {
            // Récupérez les données de la requête
            $note = $request->input('note');
            
            // Récupérer note_max de la table hackeuse
            $noteMax = Hackeuse::where('discipline_id', $disciplineId)
                                 ->where('evaluation_id', $evaluationId)
                                 ->first()->notemax;
        
            // Vérifier que la note est inférieure à note_max
            if ($note >= $noteMax) {
               return response()->json(['message' => 'La note doit être inférieure à la note maximale'], 422);
            }
            
            // Vérifier que la note est positive
            if($note <= 0){
                return response()->json(['message' => 'La note doit être supérieure à 0'],422);
            }
        $hackeuse=Hackeuse::where(['hackeuses.discipline_id'=>
        $disciplineId,'hackeuses.evaluation_id'=> $evaluationId])->first();
        $hack=$hackeuse->id;
        $inscription=Inscription::where(['inscriptions.classe_id'=>$classeId,
        'inscriptions.eleve_id'=> $eleveId])->first();
        $inscrip=$inscription->id;
        $updatedCount= Notes::where(['notes.inscription_id'=>$inscrip,'notes.hackeuse_id'=>$hack])->
        update(['note'=>$note]);
            // Mise à jour des notes comme avant
            // $updatedCount = Notes::join('inscriptions', 'notes.inscription_id', '=', 'inscriptions.id')
            // ->join('hackeuses', 'notes.hackeuse_id', '=', 'hackeuses.id')
            // ->where('inscriptions.classe_id', $classeId)
            // ->where('hackeuses.discipline_id', $disciplineId)
            // ->where('hackeuses.evaluation_id', $evaluationId)
            // ->where('inscriptions.eleve_id', $eleveId)
            // ->update(['note' => $note]);
                       
             
        
        // Mettez à jour les notes existantes pour l'élève spécifié
        
        if ($updatedCount > 0) {
            return response()->json(['message' => 'Notes mises à jour avec succès']);
        } else {
            return response()->json(['message' => 'Aucune note trouvée pour la mise à jour'], 404);
        }
    }
    

    
        public function showNotes(int $classeId)
        {
            $notes= Notes::join('inscriptions', 'notes.inscription_id', '=', 'inscriptions.id')
            ->where('inscriptions.classe_id', $classeId)
            ->select('notes.note')
            ->get();
return NoteResource::collection($notes);
}
public function showNotesDis(int $classeId, int $discId) {
       $inscriptions = Inscription::where('classe_id', $classeId)->first();
$inscrip=$inscriptions->id;
// dd($inscrip);
    // $pond = Hackeuse::where(['classe_id'=>$classeId,
    //  'discipline_id'=>$discId])->get()->pluck('id');

    $ponderations = Hackeuse::where(['classe_id' => $classeId, 'discipline_id' => $discId])->pluck('id');
    // $evaluation=Hackeuse::where('hackeuses.evaluation_id','=','evaluation_id');
    // // $evalu=$evaluation->id;
// Récupérer toutes les notes avec leurs relations
$notes = Notes::whereIn('hackeuse_id', $ponderations)
    // ->where('inscription_id', $inscrip)
    ->get();

// Grouper par inscription_id
$result = $notes->groupBy('inscription_id')
    ->map(function ($groupedNotes) {

        $notes = [];

        
        foreach ($groupedNotes as $note) {
            
              $notes[] = [
                'evaluation' => $note->hackeuse->evaluation->libelle,
                'note' => $note->note,
                'sur'=>$note->hackeuse->notemax

            ];
        }
            
        return [
            'nom' => $groupedNotes->first()->inscription->eleve->nom,
            'prenom' => $groupedNotes->first()->inscription->eleve->prenom,
            'date de naissance' => $groupedNotes->first()->inscription->eleve->datenaissance,
            'discipline'=>$groupedNotes->first()->inscription->classe->nom,
            'notes' => $notes,

        ];
    })
    ->values();

return $result;

    
    //return $notes;
    //   return $notes;
    // $classe = Classe::find($classeId);
    // $inscriptions = Inscription::where('classe_id', $classeId)->get();
    // $notes = [];
    // foreach ($inscriptions as $inscription) {
    //     $note = $inscription->note;
    //     if (!$note) {
    //         // Pas de note
    //         Log::info("Pas de note pour cette inscription n°{$inscription->id}");
    //     } else if (!$note->hackeuse) {
    //         // Pas de hackeuse associée
    //         Log::info("Note n°{$note->id} sans hackeuse associée");
    //     } else {
    //         $hackeuse = $note->hackeuse;
    //         if ($hackeuse->discipline_id == $discId) {
    //             // La note est associée à une hackeuse de la discipline spécifiée
    //             $notes[] = $note;
    //         }
    //     }
    // }
    
    
//     $hackeuse=Hackeuse::where(['hackeuses.discipline_id'=>$discId,'hackeuses.classe_id'=>$classeId])->first();
//     $hacke=$hackeuse->id;

//     $inscription=Inscription::where('inscriptions.classe_id',$classeId)->first();
// $inscrip=$inscription->id;
// // dd($inscrip);
// $notes=Notes::where(['notes.inscription_id'=>$inscrip,'notes.hackeuse_id'=>$hacke])->get();
//     // dd($note->note);
//     // $notes= Notes::join('inscriptions', 'notes.inscription_id', '=', 'inscriptions.id')
    //                ->join('hackeuses', 'notes.hackeuse_id', '=', 'hackeuses.id')
    //                 ->where('inscriptions.classe_id', $classeId)
    //                 ->where('hackeuses.discipline_id',$discId)
    //                 ->select('notes.note')
    //                 ->get();
    // // $ponderation= Hackeuse::where(['discipline_id'=>$discId,
    // 'evaluation_id'=>$evaluation_id, 'annee_id'=>1,
    // 'classe_id'=>$classeId])->first();
    // $notes= Notes::where(['hackeuse_id'=>$ponderation->id],)->get();
    //  return Response()->json($notes) ;
    // // return NoteResource::collection($notes);
}

public function showNotesEle(int $classeId, int $eleveId) {
//     $classe = Classe::find($classeId);
//     $inscriptions = Inscription::where('classe_id', $classeId)
//                                ->where('eleve_id', $eleveId)
//                                ->get();
//     $notes = [];
//     foreach ($inscriptions as $inscription) {
//         $note = $inscription->note;
//         // dd($note);
//         if (!$note) {
//             // Pas de note
//             Log::info("Pas de note pour cette inscription n°{$inscription->id}");
//         } else if (!$note->hackeuse) {
//             // Pas de hackeuse associée
//             Log::info("Note n°{$note->id} sans hackeuse associée");
//         } else {
//             // $discipline = optional($inscription->discipline)->libelle;
// // Remplacez 'nom' par le nom du champ de la discipline
//             $notes[] = $note;
//         }
//     }
// // return response()->json($notes[]);
//     return NoteResource::collection($notes);
// }public function showNotesEle(int $classe
// $hackeuse=Hackeuse::where(['hackeuses.discipline_id'=>$discId,'hackeuses.evaluation_id'=>$evaluation_id,'hackeuses.classe_id'=>$classeId])->first();
// $hacke=$hackeuse->id;

$inscription=Inscription::where(['inscriptions.classe_id'=>$classeId,'inscriptions.eleve_id'=> $eleveId])->first();
$inscrip=$inscription->id;
$notes = Notes::where(['notes.inscription_id'=>$inscrip])->select('inscription_id','note')
                 ->get();

// return response()->json($notes);
    return NoteResource::collection($notes);

}

    
}