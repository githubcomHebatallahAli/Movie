<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function createMovie( MovieRequest $request)
    {
            $movie =Movie::create ([
                'title' => $request->title,
                'summary' => $request->summary ,
                'create_at' => $request->create_at,
                'duration' => $request->duration,
                'launchedYear' => $request->launchedYear,
                'isFree' => $request->isFree,

            ]);
            $movie->addMediaFromRequest('image')->toMediaCollection('movies');
            $movie->addMediaFromRequest('video')->toMediaCollection('movies');
            $movie->save();
            // return $movie;
            return response()->json([
                'Customer' =>  $Customer,
                'message' => "Customer Update His Profile Photo Successfully."
            ], 200);


            }

        }
