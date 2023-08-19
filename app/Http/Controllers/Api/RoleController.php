<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;

class RoleController extends Controller
{
    // * get all roles data
    public function index(){
        $roles = Role::all();
        if ($roles->count() > 0) {
            $data = [
                'status' => 200,
                'roles' => $roles,
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
    
    // * get specific role data
    public function show(Role $role){
        if ($role) {
            return response()->json([
                'status' => 200,
                'role' => $role
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such role found'
            ]);
        }
    }
    
    // * add a role to the database
    public function store(RoleStoreRequest $request){
        $role = role::create($request->validated());
        if (!$role) {
            $data = [
                'status' => 500,
                'message' => 'Something went wrong !',
            ];
            return response()->json($data, 500);
        }
        return response()->json([
            'status' => 201,
            'message' => 'Role added successfully'
        ],201);
    }
    
    // * update existing role data
    public function update(RoleStoreRequest $request, Role $role){
        if ($role) {
            $role->update($request->validated());
            return response()->json([
                'status' => 200,
                'message' => 'Role updated successfully'
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such role found!'
            ],404);
        }
    }

    // * delete a role data from the database
    public function destroy(Role $role){
        if ($role) {
            $role->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Role deleted successfully'
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such role found!'
            ],404);
        }
    }
}
