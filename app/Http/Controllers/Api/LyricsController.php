<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Like;
use App\Models\User;
use App\Models\Lyrics;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\LyricsStoreRequest;

class LyricsController extends Controller
{
    // * get all lyrics data
    public function index(SearchRequest $request){
        $lyrics = Lyrics::withAllInfos()->withCount('likes');

        if ($request->validated('titre')) {
            $lyrics->includeString($request->validated('titre'));
        }

        $lyrics = $lyrics->get();
        
        $data = $lyrics;
        return response()->json($data, 200);
    }

    // * get a specific lyrics data
    public function show(Lyrics $lyrics){
        return response()->json([
            'status' => 200,
            'lyrics' => $lyrics
        ],200);
    }

    // * add a lyrics to the database
    public function store(LyricsStoreRequest $request){
        $lyrics = auth()->user()->lyrics()->create($request->validated());
        $lyrics->genres()->sync($request->validated('genres'));
        $lyrics->languages()->sync($request->validated('languages'));
        
        return response()->json([
            'status' => 201,
            'message' => 'Lyrics added successfully'
        ],201);
    }

    // * update existing lyrics 
    public function update(LyricsStoreRequest $request, Lyrics $lyrics){
        $lyrics->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Lyrics updated successfully'
        ],200);
    }

    // * delete a lyrics from the database
    public function destroy(Lyrics $lyrics){
        $lyrics->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Lyrics deleted successfully'
        ],200);
    }

    // * like a specific lyrics
    public function likeLyrics($lyrics_id){
        $lyrics = Lyrics::find($lyrics_id);
        if (!$lyrics) {
            return response()->json([
                'message' => '404 Not found'
            ],404);
        }

        // Unlike a lyrics
        if (Like::whereLyricsId($lyrics_id)->whereUserId(auth()->id())->delete()){
            return response()->json([
                'message' => 'Unliked'
            ],200);
        }
    
        // Like a lyrics
        $like = Like::create(['lyrics_id' => $lyrics_id, 'user_id' => auth()->id()]);

        return response()->json([
            'status' => 201,
            'like' => $like,
        ],201);
    }

    // * comment a specific lyrics
    public function commentLyrics(Request $request, $lyrics_id){

        $request->validate([
            'commentaire' => ['required']
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'lyrics_id' => $lyrics_id,
            'date_commentaire' => Carbon::now(),
            'commentaire'=> $request->commentaire,
        ]);

        return response()->json([
            'status' => 201,
            'comment' => $comment,
        ], 201);
    }

    // * get all comments of a specific user
    public function getComments($lyrics_id){
        $comments = Comment::with('lyrics')->with('user')->where('lyrics_id', $lyrics_id)->latest()->get();

        if (!$comments) {
            return response()->json([
                'message' => '404 Not found'
            ], 404);
        }

        return response()->json([
            'comments' => $comments
        ], 200);
    }
}
