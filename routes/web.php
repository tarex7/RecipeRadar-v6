<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('AppLayout', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('/favorites', 'RecipeController@favorites')->middleware('auth');
//Route::any('/favorite/{recipe}', [RecipeController::class, 'addFavoriteRecipe'])->name('addFavoriteRecipe');
// routes/api.php o routes/web.php




Route::get('/show/{id}', function ($id) {

    return Inertia::render('Recipes/RecipeDetail', [ 'recipe_id' => $id]);
}
    )->middleware(['auth', 'verified'])->name('recipe.show');
    

Route::get('/favorites', function () {

    return Inertia::render('Recipes/Favorites');
}
    )->middleware(['auth', 'verified'])->name('recipe.show');


require __DIR__ . '/auth.php';
