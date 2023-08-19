<?php

namespace App\Http\Controllers\Api;

use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TranslationStoreRequest;

class TranslationController extends Controller
{
    // * get all translations data
    public function index(){
        $translations = Translation::with('lyrics')->get();
        if ($translations->count() > 0) {
            $data = [
                'status' => 200,
                'translations' => $translations,
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
    
    // * get specific translation data 
    public function show(Translation $translation){
        if ($translation) {
            return response()->json([
                'status' => 200,
                'translation' => $translation
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such translation found'
            ]);
        }
    }
    
    // * add a translation to the database
    public function store(TranslationStoreRequest $request){
        $translation = Translation::create($request->validated());
        if (!$translation) {
            $data = [
                'status' => 500,
                'message' => 'Something went wrong !',
            ];
            return response()->json($data, 500);
        }
        return response()->json([
            'status' => 201,
            'message' => 'Translation added successfully'
        ],201);
    }
    
    // * update existing translation
    public function update(TranslationStoreRequest $request, Translation $translation){
        if ($translation) {
            $translation->update($request->validated());
            return response()->json([
                'status' => 200,
                'message' => 'Translation updated successfully'
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such translation found!'
            ],404);
        }
    }

    // * delete a translation from the database 
    public function destroy(Translation $translation){
        if ($translation) {
            $translation->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Translation deleted successfully'
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such translation found!'
            ],404);
        }
    }
}
