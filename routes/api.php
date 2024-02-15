<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/favorite', [RecipeController::class, 'addFavoriteRecipe'])->name('addFavoriteRecipe');
//Route::post('/favorite', [RecipeController::class, 'addFavoriteRecipe'])->middleware('auth');
//Route::post('/favorite', [RecipeController::class, 'addFavoriteRecipe'])->middleware('auth:sanctum')->name('addFavoriteRecipe');
Route::middleware('auth:sanctum')->post('/favorite', [RecipeController::class, 'addFavoriteRecipe']);
Route::middleware('auth:sanctum')->post('/checkIfFavorite/{id}', [RecipeController::class, 'checkIfFavorite']);
Route::middleware('auth:sanctum')->post('/removeFromFavorite/{id}', [RecipeController::class, 'removeFromFavorite']);
