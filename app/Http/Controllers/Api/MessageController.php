<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStoreRequest;

class MessageController extends Controller
{
    // * get all messages data
    public function index(){
        $messages = Message::with('user')->with('subject')->get();
        $data = [
            'status' => 200,
            'messages' => $messages,
        ];
        return response()->json($data, 200);
    }

    // * get specific message data
    public function show(Message $message){
        return response()->json([
            'status' => 200,
            'message' => $message
        ]);
    }

    // * add a message to the database
    public function store(MessageStoreRequest $request){
        $message = Message::create($request->validated());
        if (!$message) {
            $data = [
                'status' => 500,
                'message' => 'Something went wrong !',
            ];
            return response()->json($data, 500);
        }
        return response()->json([
            'status' => 201,
            'message' => 'Message added successfully'
        ],201);
    }

    // * update existing message
    public function update(MessageStoreRequest $request, Message $message){
        $message->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Message updated successfully'
        ],200);
    }

    // * delete a message from the database
    public function destroy(Message $message){
        $message->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Message deleted successfully'
        ],200);
    }
}
