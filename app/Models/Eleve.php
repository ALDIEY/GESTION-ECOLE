<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    public function __construct() {
        // $this->var = $var;
        // $this->numero:1,2,3;
    }
    protected $fillable = ['nom', 'prenom', 'datenaissance', 'lieu', 'sexe', 'profil', 'numero','email'];

    
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
//     public static function getElevesEtatZero()
// {
//     $eleves = Eleve::where('etat', 0)->get();

//     $elevesTableau = $eleves->pluck('numero')->toArray();

//     return $elevesTableau;
// }
    // la fonction qui donne le numero
    public static function getNumeroEleve()
    {
        // Récupérer tous les numéros des élèves ayant un état de 1 en ordre croissant
        $numerosEtatUn = Eleve::where('etat', 1)
                              ->orderBy('numero', 'asc')
                              ->pluck('numero')
                              ->toArray();
    
        // Parcourir les numéros et trouver le premier numéro absent dans l'ordre croissant
        $dernierNumero = 0;
        foreach ($numerosEtatUn as $numero) {
            if ($numero > $dernierNumero + 1) {
                // Trouvé le premier numéro absent, retourner le numéro précédent
                return $dernierNumero + 1;
            }
            $dernierNumero = $numero;
        }
    
        // Si tous les numéros sont présents, générer un nouveau numéro en fonction du dernier numéro attribué
        return $dernierNumero + 1;
    }
    public function classes()
{
    return $this->belongsToMany(Classe::class, 'inscriptions', 'eleve_id', 'classe_id');
}

public function inscription()
{
    return $this->hasMany(Inscription::class);
}  
    
}
