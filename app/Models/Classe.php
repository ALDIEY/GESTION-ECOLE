<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'niveau_id',
    ];
    public $timestamps = false;

    // Relation avec le modèle Niveau
    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }
    public function hackeuses()
{
    return $this->hasMany(Hackeuse::class,'discipline_id');
}
public function elevese()
{
    return $this->belongsToMany(Eleve::class, 'inscriptions', 'classe_id', 'eleve_id');
}

public function inscription()
{
    return $this->hasMany(Inscription::class,'classe_id');
}

}

