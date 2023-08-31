<?php

namespace App\Http\Controllers\Api;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageStoreRequest;

class LanguageController extends Controller
{
    // * get all languages data
    public function index(){
        $languages = Language::with('lyrics')->get();
        $data = [
            'status' => 200,
            'languages' => $languages,
        ];
        return response()->json($data, 200);
    }

    // * get specific language data
    public function show(Language $language){
        return response()->json([
            'status' => 200,
            'language' => $language
        ]);
    }

    // * add a language to the database
    public function store(LanguageStoreRequest $request){
        $language = Language::create($request->validated());
        if (!$language) {
            $data = [
                'status' => 500,
                'message' => 'Something went wrong !',
            ];
            return response()->json($data, 500);
        }
        return response()->json([
            'status' => 201,
            'message' => 'Language added successfully'
        ],201);
    }

    // * update existing language
    public function update(LanguageStoreRequest $request, Language $language){
        $language->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Language updated successfully'
        ],200);
    }

    // * delete a language from the database
    public function destroy(Language $language){
        $language->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Language deleted successfully'
        ],200);
    }
}
