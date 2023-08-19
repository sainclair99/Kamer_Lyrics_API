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
        if ($comments->count() > 0) {
            $data = [
                'status' => 200,
                'comments' => $comments,
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No records found',
            ];
            return response()->json($data, 404);
        }
    }

    // * get specific comment data
    public function show(Comment $comment){
        if ($comment) {
            return response()->json([
                'status' => 200,
                'comment' => $comment
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such comment found'
            ]);
        }
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
        if ($comment) {
            $comment->update($request->validated());
            return response()->json([
                'status' => 200,
                'message' => 'Comment updated successfully'
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such comment found!'
            ],404);
        }
    }

    // * delete a category from the database
    public function destroy(Comment $comment){
        if ($comment) {
            $comment->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Comment deleted successfully'
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such comment found!'
            ],404);
        }
    }
}
