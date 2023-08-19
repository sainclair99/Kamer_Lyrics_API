<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
    // * get all categories data
    public function index(){
        $categories = Category::all();
        if ($categories->count() > 0) {
            $data = [
                'status' => 200,
                'categories' => $categories,
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

    // * get specific category data
    public function show(Category $category){
        if ($category) {
            return response()->json([
                'status' => 200,
                'category' => $category
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such category found'
            ]);
        }
    }

    // * add a category to the database
    public function store(CategoryStoreRequest $request){
        $category = Category::create($request->validated());
        
        if (!$category) {
            $data = [
                'status' => 500,
                'message' => 'Something went wrong !',
            ];
            return response()->json($data, 500);
        }
        return response()->json([
            'status' => 201,
            'message' => 'Category added successfully'
        ],201);

    }

    // * update existing category
    public function update(CategoryStoreRequest $request, Category $category){
        if ($category) {
            $category->update($request->validated());
            return response()->json([
                'status' => 200,
                'message' => 'Category updated successfully'
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such category found!'
            ],404);
        }
    }

    // * delete a category from the database
    public function destroy(Category $category){
        if ($category) {
            $category->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Category deleted successfully'
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such category found!'
            ],404);
        }
    }
}
