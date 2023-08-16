<?php

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LyricsController;
use App\Http\Controllers\Api\ArticleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function (){

    // * LYRICS PROTECTED ROUTES
    Route::post('/lyrics',[LyricsController::class,'store'])->middleware(['auth:sanctum', 'admin']);
    Route::post('/lyrics/{lyrics_id}',[LyricsController::class,'likeLyrics']); // * Like or Unlike a lyrics
    Route::post('/lyrics/comment/{lyrics_id}',[LyricsController::class,'commentLyrics']); // * comment a lyrics
    Route::get('/lyrics/comments/{lyrics_id}',[LyricsController::class,'getComments']); // * get all comments of specific lyrics with author 
    Route::put('/lyrics/{lyrics}',[LyricsController::class,'update'])->middleware(['auth:sanctum', 'admin']);
    Route::delete('/lyrics/{lyrics}',[LyricsController::class,'destroy'])->middleware(['auth:sanctum', 'admin']);

});

// * Authentification ROUTES
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// * LYRICS CRUD ROUTES
Route::get('/lyrics',[LyricsController::class,'index']);
Route::get('/lyrics/{lyrics}',[LyricsController::class,'show']);

// * ARTISTS CRUD ROUTES
Route::get('/artists',[ArtistController::class,'index']);
Route::post('/artists',[ArtistController::class,'store']);
Route::get('/artists/{artist}',[ArtistController::class,'show']);
Route::put('/artists/{artist}',[ArtistController::class,'update']);
Route::delete('/artists/{artist}',[ArtistController::class,'destroy']);

// TODO ARTICLES CRUD ROUTES 
Route::get('/articles',[ArticleController::class,'index']);
Route::post('/articles',[ArticleController::class,'store']);
Route::get('/articles/{article}',[ArticleController::class,'show']);
Route::put('/articles/{article}',[ArticleController::class,'update']);
Route::delete('/articles/{article}',[ArticleController::class,'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
