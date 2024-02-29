<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'taxes',
        'user_id',
        'movie_id',
    ];
    function movies(){

        return $this->hasMany(Movie::class);
    }
}
