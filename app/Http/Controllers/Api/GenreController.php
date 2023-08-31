<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GenreStoreRequest;

class GenreController extends Controller
{
    // * get all genres data
    public function index(){
        $genres = Genre::withArticles()->withLyrics()->get();
        $data = [
            'status' => 200,
            'genres' => $genres,
        ];
        return response()->json($data, 200);
    }
    
    // * get specific genre data
    public function show(Genre $genre){
        return response()->json([
            'status' => 200,
            'genre' => $genre
        ]);
    }

    // * add a genre to the database
    public function store(GenreStoreRequest $request){
        $genre = Genre::create($request->validated());
        if (!$genre) {
            $data = [
                'status' => 500,
                'message' => 'Something went wrong !',
            ];
            return response()->json($data, 500);
        }
        return response()->json([
            'status' => 201,
            'message' => 'Genre added successfully'
        ],201);
    }

    // * update existing genre
    public function update(GenreStoreRequest $request, Genre $genre){
        $genre->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Genre updated successfully'
        ],200);
    }

    // * delete a genre from the database
    public function destroy(Genre $genre){
        $genre->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Genre deleted successfully'
        ],200);
    }
}
