<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Metadata\Uses;
use App\Models\User;

class Evenement extends Model
{
    use HasFactory;
    protected $table = 'evenements';
    public $timestamps = false;
    protected $fillable = ['date', 'nom','description','user_id'];
    public function classes()
{
    return $this->belongsToMany(Classe::class, 'even_classes', 'evenement_id', 'classe_id');
}
public function createur()
{
    return $this->belongsTo(User::class, 'user_id');
}
public function even_classe()
{
    return $this->hasMany(EvenClass::class);
}
}
