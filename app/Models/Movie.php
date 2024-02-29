<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Movie extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $fillable = [
        'title',
     'summary',
    //  'video',
    //  'image',
     'create_at',
     'duration',
     'launchedYear',
     'isFree'
    ];
    CONST ISFREE=[
        0 => 'Free',
        1 => 'Paid'
    ];
    function users(){
        return $this->belongsToMany(User::class,'movie_users');
}
function reviews(){

    return $this->hasMany(Review::class);
}
function categories(){

    return $this->belongsToMany(Category::class,'category_movies');
}
function payments(){

    return $this->belongsTo(Payment::class);
}
}
