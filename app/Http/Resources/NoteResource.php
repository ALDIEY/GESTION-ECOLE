<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
   
        public function toArray($request)
{
    return [
        'eleve' => [
            'nom' => $this->inscription->eleve->nom,
            'prenom' => $this->inscription->eleve->prenom,
        ],
        // 'evaluation' => $this->hackeuses->evaluation->libelle,
        // 'discipline' => $this->hackeuses->discipline->libelle,
         'note' => $this->note,
    ];


    }
}
