<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @parent::toArray($request);return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "eleve"=>$this->eleve,
            "classe"=>$this->whenLoaded("classe")
        ];

    }
}
