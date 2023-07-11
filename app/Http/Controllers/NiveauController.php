<?php



namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;
use App\Traits\JoinQueryParams;

class NiveauController extends Controller
{
    use JoinQueryParams;
    public function index()
    {

    //     $users = Niveau::all();

    // return $users;
    return Niveau::with('classes')->get();

    

        // $valeur=$request->query('join');
        // if ($valeur='classe') 
        // {
        //     $niveau  =new Niveau();
        //     return $niveau->($valeur);
        //     # code...
        // }
        
    }
    public function indexe()
    {
        $niveaux = Niveau::all();

        return view('eleve.create', compact('niveaux'));
    }

    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
    
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
         }

    public function destroy($id)
    {
    }
    public function show($id){

        return Niveau::find($id);
        
    }
    public function showNiveau()
{
    // Récupérez les données nécessaires pour le niveau depuis votre modèle ou autre source de données
    $niveaux = Niveau::with('classes')->get(); // Inclut la relation "classe" dans la requête
    // dd($niveaux);
    // Retournez la vue avec les données
    return view('niveau')->with('niveaux', $niveaux);
}

}