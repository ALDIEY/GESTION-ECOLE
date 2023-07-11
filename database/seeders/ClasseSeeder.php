<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Classe;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
       

        DB::table('classes')->insert([
    
            'nom' => '2nd',
            'niveau_id' => 3,

        ]);
        // Classe::create([
        //     'nom' => 'CM2',
        //     'niveau_id' => 1,
        // ]);

    }
}
