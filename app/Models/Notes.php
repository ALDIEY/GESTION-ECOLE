<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;
  protected  $fillable=[
'note','inscription_id','hackeuse_id','class_semestre_id'
];
public function hackeuse()
{
    return $this->belongsTo(Hackeuse::class, 'hackeuse_id');
}
public function inscription()
{
    return $this->belongsTo(Inscription::class,'inscription_id');
}

}
