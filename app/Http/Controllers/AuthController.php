<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
  
    public function register(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        'role' => 'required|string|in:condidateur,recruteur', 
    ]);

    if ($request->role === "condidateur" || $request->role === "recruteur") {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json(['message' => 'Utilisateur créé avec succès'], 201);
    } else {
        return response()->json(['message' => 'Ce rôle  pas valide']);
    }
    }
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    public function me(){
        return response()->json(Auth::guard('api')->user());
    }
    public function logout(){
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Déconnexion réussie']);
    }
    public function refresh(){
        return $this->respondWithToken(Auth::guard('api')->refresh());
    }
    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}
