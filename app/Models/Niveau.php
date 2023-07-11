<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Niveau extends Model
{
    public $timestamps = false;
    protected $table = 'niveaux'; // Nom de la table si différent de "niveaux"
    protected $fillable = [
        'nom',
    ];
    // Relation avec la classe Classe
    public function classes()
{
    return $this->hasMany(Classe::class);
}

}
