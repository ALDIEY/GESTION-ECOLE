<?php

namespace App\Models;
use App\Models\Evenement;
use App\Models\Classe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenClass extends Model
{
    use HasFactory;
    public function evenement(){
        return $this->belongsTo(Evenement::class);
        
    }
    public function classe(){
        return $this->belongsTo(Classe::class);
        
    }
}
