<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\SortieController;

//Route::get('/user', function (Request $request) {
  //  return $request->user();
//})->middleware('auth:sanctum');

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {
    // Authentification
    Route::post('/logout', [AuthController::class, 'logout']);

    // Produits
    Route::apiResource('produits', ProduitController::class);

    // Entrées (nested dans produits)
    Route::prefix('produits/{produit}')->group(function () {
        Route::apiResource('entrees', EntreeController::class)->except(['store', 'update']);
        Route::post('entrees', [EntreeController::class, 'store']);
        Route::put('entrees/{entree}', [EntreeController::class, 'update']);
    });

    // Sorties (nested dans produits)
    Route::prefix('produits/{produit}')->group(function () {
        Route::apiResource('sorties', SortieController::class)->except(['store', 'update']);
        Route::post('sorties', [SortieController::class, 'store']);
        Route::put('sorties/{sortie}', [SortieController::class, 'update']);
    });
});
