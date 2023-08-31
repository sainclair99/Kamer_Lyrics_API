<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleStoreRequest;

class ArticleController extends Controller
{
    // * get all articles data
    public function index(){
        $articles = Article::all();
        $data = [
            'status' => 200,
            'articles' => $articles,
        ];
        return response()->json($data, 200);
    }
    
    // * get one specific article data
    public function show(Article $article){
        return response()->json([
            'status' => 200,
            'article' => $article
        ]);
    }
    
    // * add an article to the database
    public function store(ArticleStoreRequest $request){
        $article = Article::create($request->validated());
        if ($article) {
            return response()->json([
                'status' => 201,
                'message' => 'Article added successfully'
            ],201);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Somethings went wrong!'
            ],500);
        }
    }
    
    // * update existing article 
    public function update(ArticleStoreRequest $request, Article $article){
        $article->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Article updated successfully'
        ],200);
    }
    
    // * delete an article from the database
    public function destroy(Article $article){
        $article->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Article deleted successfully'
        ],200);
    }
}
