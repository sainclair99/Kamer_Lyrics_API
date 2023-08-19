<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectStoreRequest;

class SubjectController extends Controller
{
    // * get all subjects data
    public function index(){
        $subjects = Subject::with('messages')->get();
        if ($subjects->count() > 0) {
            $data = [
                'status' => 200,
                'subjects' => $subjects,
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
    
    // * get specific subject data
    public function show(Subject $subject){
        if ($subject) {
            return response()->json([
                'status' => 200,
                'subject' => $subject
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such subject found'
            ]);
        }
    }
    
    // * add a subject to the database
    public function store(SubjectStoreRequest $request){
        $subject = Subject::create($request->validated());
        if (!$subject) {
            $data = [
                'status' => 500,
                'message' => 'Something went wrong !',
            ];
            return response()->json($data, 500);
        }
        return response()->json([
            'status' => 201,
            'message' => 'Subject added successfully'
        ],201);
    }
    
    // * update existing subject
    public function update(SubjectStoreRequest $request, Subject $subject){
        if ($subject) {
            $subject->update($request->validated());
            return response()->json([
                'status' => 200,
                'message' => 'Subject updated successfully'
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such subject found!'
            ],404);
        }
    }
    
    // * delete a subject from the database
    public function destroy(Subject $subject){
        if ($subject) {
            $subject->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Subject deleted successfully'
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such subject found!'
            ],404);
        }
    }
}
