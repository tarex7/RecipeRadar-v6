<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\RecipeIngredients;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{

public function favorite() {
    
}

    public function addFavoriteRecipe(Request $request)
    {
        $recipe = Recipe::updateOrCreate(
            [
                // Criteri di ricerca: verifica l'esistenza di un record basato su `recipe_id`
                'recipe_id' => $request->recipe_id,
                'user_id' => Auth::user()->id,
            ],
            [
                // Valori da aggiornare o utilizzare per la creazione
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'category' => $request->category,
                'area' => $request->area,
                'instructions' => $request->instructions,
                'tags' => $request->tags,
                'video_url' => $request->video_url,
                'image_url' => $request->image_url,
                'favorite' => $request->favorite
            ]
        );



        foreach ($request->ingredients as $ing) {
            RecipeIngredients::updateOrCreate(
                [
                    // Criteri di ricerca: verifica l'esistenza di un record basato su `recipe_id` e `ingredient`
                    'recipe_id' => $recipe->id,
                    'ingredient' => $ing['name'],
                ],
                [

                    'measure' => $ing['measure']
                ]
            );
        }



        return response()->json(['message' => 'Recipe added to favorites', 'recipe' => $recipe]);
    }

    public function checkIfFavorite($id)
    {
        $recipe = Recipe::where('recipe_id', $id)->first();
        if ($recipe != null) {
            return $recipe->favorite;
        } 
    }

    public function removeFromFavorite($id)
    {
        $recipe = Recipe::where('recipe_id', $id)->first();
    
        if ($recipe) {
            $recipe->delete();
            return response()->json(['message' => 'Recipe removed from favorites']);
        } else {
            return response()->json(['message' => 'Recipe not found'],  404);
        }
    }
    
}
