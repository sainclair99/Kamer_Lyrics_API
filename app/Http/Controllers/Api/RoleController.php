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
        $data = [
            'status' => 200,
            'roles' => $roles,
        ];
        return response()->json($data, 200);
    }
    
    // * get specific role data
    public function show(Role $role){
        return response()->json([
            'status' => 200,
            'role' => $role
        ]);
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
        $role->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Role updated successfully'
        ],200);
    }

    // * delete a role data from the database
    public function destroy(Role $role){
        $role->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Role deleted successfully'
        ],200);
    }
}
