<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipe_id','user_id', 'name', 'category', 'area', 'instructions', 'image_url', 'tags', 'video_url', 'favorite'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
