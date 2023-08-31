<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;

class CommentController extends Controller
{
    // * get all comments data
    public function index(){
        $comments = Comment::with('user')->with('lyrics')->get();
        $data = [
            'status' => 200,
            'comments' => $comments,
        ];
        return response()->json($data, 200);
    }

    // * get specific comment data
    public function show(Comment $comment){
        return response()->json([
            'status' => 200,
            'comment' => $comment
        ]);
    }

    // * add a comment to the database
    public function store(CommentStoreRequest $request){
        $comment = Comment::create($request->validated());
        if (!$comment) {
            $data = [
                'status' => 500,
                'message' => 'Something went wrong !',
            ];
            return response()->json($data, 500);
        }
        return response()->json([
            'status' => 201,
            'message' => 'Comment added successfully'
        ],201);
    }

    // * update existing comment
    public function update(CommentStoreRequest $request, Comment $comment){
        $comment->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Comment updated successfully'
        ],200);
    }

    // * delete a category from the database
    public function destroy(Comment $comment){
        $comment->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Comment deleted successfully'
        ],200);
    }
}
