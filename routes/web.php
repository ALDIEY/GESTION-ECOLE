<?php
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InscriptionController;
use App\Models\Eleve;
use App\Models\Inscription;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


 Auth::routes();
Route::get('/home',[App\Http\Controllers\HomeController::class,'index'])->name('home');


Route::get('/', function () {
    return view('users.login');
});

// Route de test


// Routes pour les utilisateurs
Route::resource('users', UserController::class);
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// Routes pour les niveaux
Route::resource('breukh-api/voirniveau', NiveauController::class);

Route::resource('niveau', NiveauController::class);


Route::get('breukh-api/niveaux', [NiveauController::class, 'showNiveau'])->name('niveau');

Route::get('breukh-api/classes/{niveauId}', [ClasseController::class, 'getClassesByNiveaus']);


// Route::get('breukh-api/eleves/create', [EleveController::class, 'store']);


// Route::get('breukh-api/eleves/create', [EleveController::class, 'create'])->name('eleve.create');