<?php

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\LyricsController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\TranslationController;

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
    Route::post('/lyrics/{lyrics_id}/like',[LyricsController::class,'likeLyrics']); // * Like or Unlike a lyrics
    Route::post('/lyrics/{lyrics_id}/comment',[LyricsController::class,'commentLyrics']); // * comment a lyrics
    Route::get('/lyrics/{lyrics_id}/comments',[LyricsController::class,'getComments']); // * get all comments of specific lyrics with author 
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

// * ARTICLES CRUD ROUTES 
Route::get('/articles',[ArticleController::class,'index']);
Route::post('/articles',[ArticleController::class,'store']);
Route::get('/articles/{article}',[ArticleController::class,'show']);
Route::put('/articles/{article}',[ArticleController::class,'update']);
Route::delete('/articles/{article}',[ArticleController::class,'destroy']);

// * Categories CRUD ROUTES 
Route::get('/categories',[CategoryController::class,'index']);
Route::post('/categories',[CategoryController::class,'store']);
Route::get('/categories/{category}',[CategoryController::class,'show']);
Route::put('/categories/{category}',[CategoryController::class,'update']);
Route::delete('/categories/{category}',[CategoryController::class,'destroy']);

// * Comments CRUD ROUTES 
Route::get('/comments',[CommentController::class,'index']);
Route::post('/comments',[CommentController::class,'store']);
Route::get('/comments/{comment}',[CommentController::class,'show']);
Route::put('/comments/{comment}',[CommentController::class,'update']);
Route::delete('/comments/{comment}',[CommentController::class,'destroy']);

// * Genres CRUD ROUTES 
Route::get('/genres',[GenreController::class,'index']);
Route::post('/genres',[GenreController::class,'store']);
Route::get('/genres/{genre}',[GenreController::class,'show']);
Route::put('/genres/{genre}',[GenreController::class,'update']);
Route::delete('/genres/{genre}',[GenreController::class,'destroy']);

// * Languages CRUD ROUTES 
Route::get('/languages',[LanguageController::class,'index']);
Route::post('/languages',[LanguageController::class,'store']);
Route::get('/languages/{language}',[LanguageController::class,'show']);
Route::put('/languages/{language}',[LanguageController::class,'update']);
Route::delete('/languages/{language}',[LanguageController::class,'destroy']);

// * Messages CRUD ROUTES 
Route::get('/messages',[MessageController::class,'index']);
Route::post('/messages',[MessageController::class,'store']);
Route::get('/messages/{message}',[MessageController::class,'show']);
Route::put('/messages/{message}',[MessageController::class,'update']);
Route::delete('/messages/{message}',[MessageController::class,'destroy']);

// * Roles CRUD ROUTES 
Route::get('/roles',[RoleController::class,'index']);
Route::post('/roles',[RoleController::class,'store']);
Route::get('/roles/{role}',[RoleController::class,'show']);
Route::put('/roles/{role}',[RoleController::class,'update']);
Route::delete('/roles/{role}',[RoleController::class,'destroy']);

// * Subjects CRUD ROUTES 
Route::get('/subjects',[SubjectController::class,'index']);
Route::post('/subjects',[SubjectController::class,'store']);
Route::get('/subjects/{subject}',[SubjectController::class,'show']);
Route::put('/subjects/{subject}',[SubjectController::class,'update']);
Route::delete('/subjects/{subject}',[SubjectController::class,'destroy']);

// * Subjects CRUD ROUTES 
Route::get('/translations',[TranslationController::class,'index']);
Route::post('/translations',[TranslationController::class,'store']);
Route::get('/translations/{translation}',[TranslationController::class,'show']);
Route::put('/translations/{translation}',[TranslationController::class,'update']);
Route::delete('/translations/{translation}',[TranslationController::class,'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
