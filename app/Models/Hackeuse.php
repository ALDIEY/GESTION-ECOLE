<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notes;

class Hackeuse extends Model
{
    use HasFactory;
    protected $fillable=['notemax','classe_id','annee_id','discipline_id','evaluation_id'];
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function annee()
    {
        return $this->belongsTo(Annee::class);
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class,'libelle');
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class,);
    }
    public function note()
    {
        return $this->hasOne(Note::class, 'hackeuse_id');
    }
}

