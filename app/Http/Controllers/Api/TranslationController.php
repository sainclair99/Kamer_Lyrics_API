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
        $data = [
            'status' => 200,
            'translations' => $translations,
        ];
        return response()->json($data, 200);
    }
    
    // * get specific translation data 
    public function show(Translation $translation){
        return response()->json([
            'status' => 200,
            'translation' => $translation
        ]);
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
        $translation->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Translation updated successfully'
        ],200);
    }

    // * delete a translation from the database 
    public function destroy(Translation $translation){
        $translation->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Translation deleted successfully'
        ],200);
    }
}
