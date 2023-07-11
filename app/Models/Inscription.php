<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Eleve;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'classe_id',
        'annee_id',
        'datascription'
        // Autres champs de l'inscription
    ];

    // Définir les relations avec les autres modèles
    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    

    public function annee()
    {
        return $this->belongsTo(Annee::class, 'annee_id');
    }
    public function note()
{
    return $this->hasOne(Notes::class);
}


    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
