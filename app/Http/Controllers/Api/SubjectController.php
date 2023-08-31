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
        $data = [
            'status' => 200,
            'subjects' => $subjects,
        ];
        return response()->json($data, 200);
    }
    
    // * get specific subject data
    public function show(Subject $subject){
        return response()->json([
            'status' => 200,
            'subject' => $subject
        ]);
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
        $subject->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Subject updated successfully'
        ],200);
    }
    
    // * delete a subject from the database
    public function destroy(Subject $subject){
        $subject->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Subject deleted successfully'
        ],200);
    }
}
