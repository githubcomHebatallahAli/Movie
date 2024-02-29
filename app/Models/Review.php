<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'stars',
        'status',
        'comment',
        'user_id',
        'movie_id'
    ];
    CONST STARS=[
        0 => 'One Star',
        1 => 'Two Stars',
        2 => 'Three Stars',
        3 => 'Four Stars'
    ];

    CONST STATUS=[
        0 => 'Hide',
        1 => 'UnHide'
    ];

    function movies(){
        return $this->belongsTo(Movie::class);
    }

    public function users()
{
    return $this->belongsTo(User::class);
}
}
