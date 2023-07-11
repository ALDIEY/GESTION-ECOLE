<?php

namespace App\Http\Controllers;

use App\Http\Resources\EleveResource;
use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Annee;
use App\Models\Inscription;

class InscriptionController extends Controller
{
    //
    public function getEleveByClasse($classeId)
{
   

$eleves = Eleve::join('inscriptions', 'eleves.id', '=', 'inscriptions.eleve_id')
    ->where('inscriptions.classe_id', $classeId)
    ->get();
    return EleveResource::collection($eleves);


}
}
