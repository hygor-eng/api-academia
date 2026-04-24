<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    InstrutorController,
    PlanoController,
    AlunoController,
    MatriculaController,
    AulaController
};

Route::apiResource('instrutores', InstrutorController::class);
Route::apiResource('planos', PlanoController::class);
Route::apiResource('alunos', AlunoController::class);
Route::apiResource('matriculas', MatriculaController::class);
Route::apiResource('aulas', AulaController::class);
