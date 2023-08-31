<?php

namespace App\Http\Controllers\Api;

use App\Models\Artist;
use App\Models\Follow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\ArtistStoreRequest;

class ArtistController extends Controller
{
    // * get all artists data
    public function index(SearchRequest $request){
        $artists = Artist::withCount('lyrics')->with('lyrics')->with('albums')->withCount('followers')->with('alias');

        if($request->validated('nom')){
            $artists->where('nom', 'like', "%{$request->validated('nom')}%");
        }

        if($request->validated('genre_musical')){
            $artists->where('genre_musical', 'like', "%{$request->validated('genre_musical')}%");
        }
        $data = $artists->get();
        return response()->json($data, 200);
    }
    
    // * get a specific artist data
    public function show(Artist $artist){
        return response()->json($artist,200);
    }
    
    // * store a new artist in the database
    public function store(ArtistStoreRequest $request){

        $artist = Artist::create($request->validated());

        if (!$artist) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong',
            ],500);
        }

        return response()->json([
            'status' => 201,
            'message' => 'Artist added successfully !',
        ],201);
    }

    // * update existing artist data informations
    public function update(ArtistStoreRequest $request, Artist $artist){
        $artist->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'artist updated successfully'
        ],200);
    }

    // * delete an artist data from the database
    public function destroy(Artist $artist){
        $artist->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Artist deleted successfully'
        ],200);
    }

    // * 
    public function follow($artist_id){
        $artist = Artist::find($artist_id);
        if (!$artist) {
            return response()->json([
                'message' => '404 Not found'
            ],404);
        }

        // Unfollow an artist
        if (Follow::whereArtistId($artist_id)->whereUserId(auth()->id())->delete()){
            return response()->json([
                'message' => 'Unfollowed'
            ],200);
        }
    
        // Follow an artist
        Follow::create(['artist_id' => $artist_id, 'user_id' => auth()->id()]);
        return response()->json([
            'message' => 'Followed'
        ],200);
    }
}
