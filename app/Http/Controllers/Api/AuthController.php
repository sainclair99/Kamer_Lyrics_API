<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    // * register
    public function register(RegisterRequest $request){
        $request->validated();

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = User::create($userData);
        
        $token = $user->createToken('kamer_lyrics')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token'=> $token,
        ], 201);
    }
    
    // * login
    public function login(LoginRequest $request){
        $request->validated();
        $user = User::with('roles')->whereEmail($request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status_code' => 422,
                'messages' => 'Invalid Informations'
            ], 422); 
        }

        $token = $user->createToken('kamer_lyrics')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token'=> $token,
        ], 200);
    }
    
    // * logout
    public function logout(){
        
    }
}
