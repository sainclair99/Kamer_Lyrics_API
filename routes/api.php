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
    // Route::post('/lyrics',[LyricsController::class,'store'])->middleware(['auth:sanctum', 'admin']);
    Route::post('/lyrics/{lyrics_id}/like',[LyricsController::class,'likeLyrics']); // * Like or Unlike a lyrics
    Route::post('/lyrics/{lyrics_id}/comment',[LyricsController::class,'commentLyrics']); // * comment a lyrics
    Route::get('/lyrics/{lyrics_id}/comments',[LyricsController::class,'getComments']); // * get all comments of specific lyrics with author 
    Route::put('/lyrics/{lyrics}',[LyricsController::class,'update'])->middleware(['auth:sanctum', 'admin']);
    // Route::delete('/lyrics/{lyrics}',[LyricsController::class,'destroy'])->middleware(['auth:sanctum', 'admin']);
    Route::get('/me', [AuthController::class, 'show']);

    Route::post('/artists/{artist_id}/follow',[ArtistController::class,'follow']); // * Follow or Unfollow an artist

    // * Protected Authentification ROUTES
    Route::post('/logout', [AuthController::class, 'logout']);
});

// * Authentification ROUTES
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// * LYRICS CRUD ROUTES
Route::apiResource('lyrics',LyricsController::class)->middleware('auth:sanctum')->except('index', 'show');
Route::get('/lyrics',[LyricsController::class,'index']);
Route::get('/lyrics/{lyrics}',[LyricsController::class,'show']);

// * ARTISTS CRUD ROUTES
Route::apiResource('artists',ArtistController::class)->middleware('auth:sanctum')->except('index', 'show');
Route::get('/artists',[ArtistController::class,'index']);
Route::get('/artists/{artist}',[ArtistController::class,'show']);

// * ARTICLES CRUD ROUTES
Route::apiResource('articles',ArticleController::class)->middleware('auth:sanctum')->except('index', 'show');
Route::get('/articles',[ArticleController::class,'index']);
Route::get('/articles/{article}',[ArticleController::class,'show']);

// * Categories CRUD ROUTES
Route::apiResource('categories',CategoryController::class)->middleware('auth:sanctum')->except('index', 'show');
Route::get('/categories',[CategoryController::class,'index']);
Route::get('/categories/{category}',[CategoryController::class,'show']);

// * Comments CRUD ROUTES
Route::apiResource('comments',CommentController::class)->middleware('auth:sanctum')->except('index', 'show');
Route::get('/comments',[CommentController::class,'index']);
Route::get('/comments/{comment}',[CommentController::class,'show']);

// * Genres CRUD ROUTES
Route::apiResource('genres',GenreController::class)->middleware('auth:sanctum')->except('index', 'show');
Route::get('/genres',[GenreController::class,'index']);
Route::get('/genres/{genre}',[GenreController::class,'show']);

// * Languages CRUD ROUTES
Route::apiResource('languages',LanguageController::class)->middleware('auth:sanctum')->except('index', 'show');
Route::get('/languages',[LanguageController::class,'index']);
Route::get('/languages/{language}',[LanguageController::class,'show']);

// * Messages CRUD ROUTES
Route::apiResource('messages',MessageController::class)->middleware('auth:sanctum')->except('index', 'show');
Route::get('/messages',[MessageController::class,'index']);
Route::get('/messages/{message}',[MessageController::class,'show']);

// * Roles CRUD ROUTES
Route::apiResource('roles',RoleController::class)->middleware('auth:sanctum')->except('index', 'show');
Route::get('/roles',[RoleController::class,'index']);
Route::get('/roles/{role}',[RoleController::class,'show']);

// * Subjects CRUD ROUTES
Route::apiResource('subjects',SubjectController::class)->middleware('auth:sanctum')->except('index', 'show');
Route::get('/subjects',[SubjectController::class,'index']);
Route::get('/subjects/{subject}',[SubjectController::class,'show']);

// * Subjects CRUD ROUTES
Route::apiResource('translations',TranslationController::class)->middleware('auth:sanctum')->except('index', 'show');
Route::get('/translations',[TranslationController::class,'index']);
Route::get('/translations/{translation}',[TranslationController::class,'show']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
