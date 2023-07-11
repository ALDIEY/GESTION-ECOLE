<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\HackeuseController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\NotesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psy\Command\ListCommand\ClassEnumerator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


    // Vos routes d'API ici
    // Route::get('eleves', 'EleveController@index');
    // ...
    // Route::post('/evenements', [EvenementController::class,'store'])->middleware('auth');
Route::get('classe/{classeId}/notes',[ClasseController::class,'showNotes']);
Route::get('classe/{classeId}/discipline/{disId}/notes',[ClasseController::class,'showNotesDis']);
Route::get('classe/{classeId}/notes/eleve/{elevesId}',[ClasseController::class,'showNotesEle']);
Route::put('/classe/{classeId}/discipline/{disciplineId}/evaluation/{evaluationId}/eleve/{eleveId}',[ClasseController::class,'updateNote']);


Route::get('/niveau', [NiveauController::class, 'index']);
Route::apiResource('/eleves',EleveController::class)->only(['store']);
Route::apiResource('/classes', ClasseController::class)->only(['store','index']);
Route::apiResource('/evenements',EvenementController::class)->only(['store','index']);
Route::get('/evenement/{evenementId}/participants', [EvenementController::class,'getParticipants']);
Route::post('/evenement/{evenementId}/participants', [EvenementController::class,'AddParticipants']);




Route::post('/eleves', [EleveController::class, 'store']);
Route::get('/classe/{classeId}/eleves', [InscriptionController::class, 'getEleveByClasse']);
Route::post('/classe/{classeId}/discipline/{disId}/evaluation/{evaId}',[ClasseController::class,'ajoutNote'] );

Route::apiResource('/classes/{id}/coef', HackeuseController::class)->only(['store']);
Route::get('/classes/{id}/coef', [HackeuseController::class,'show']);

Route::apiResource('/disciplines',DisciplineController::class)->only(['store','index']);
Route::apiResource('/evaluations',EvaluationController::class)->only(['store','index']);

Route::put('/eleves/sortie',[EleveController::class, 'sortie']);
