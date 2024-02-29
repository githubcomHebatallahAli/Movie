<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'parent_id'
    ];
    function movies(){

        return $this->belongsToMany(Movie::class,'category_movies');
    }
    // public function subcategories()
    // {
    //     return $this->hasMany(Category::class, 'parent_id');
    // }
}
