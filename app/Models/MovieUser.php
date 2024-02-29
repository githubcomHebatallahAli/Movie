<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'movie_id',
        'isLiked'

    ];
    CONST ISLIKED=[
        0 => 'Like',
        1 => 'DisLike'
    ];
}
