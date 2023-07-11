<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semestres;

class SemestresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
      $semestre=[
    [ 
        "libelle"=>'Trimestre 1',
        "niveau_id"=>1
    ],
    [
        "libelle"=>'Trimestre 2',
        "niveau_id"=>1
    ],
    [
        "libelle"=>'Trimestre 3',
        "niveau_id"=>1
    ],
    [
        "libelle"=>'Semestre 1', 
        "niveau_id"=>2
    ],
    [
        "libelle"=>'Semestre 2',
        "niveau_id"=>2
    ],
    [
        "libelle"=>'Semestre 1',
        "niveau_id"=>3
    ],
    [
        "libelle"=>'Semestre 2',
        "niveau_id"=>3
        ]

      ];
      Semestres::insert($semestre);

    }
}
