<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class UserController extends Controller
{
    //
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        // Les informations d'identification sont invalides
        if(!Auth::attempt($credentials)){
            return response()->json(['message' => 'Échec de la connexion'], 401);
        } else {
            $admin = User::where('email', $request->email)->first();

             // Vérifier si l'utilisateur est un administrateur
            if (!$admin->is_admin){
            return response()->json(['message' => 'Échec de la connexion'], 401);
            }else{
                // Créer un jeton d'accès pour l'utilisateur
            $token = $admin->createToken('token-name')->plainTextToken ;
            return response()->json([
                "email" => $request->email,
                'message' => 'Connexion réussie',
                'token' => $token
        ]);
            }
        }
    }

    // logout de l'admin

    public function logout (Request $request){
        User::where('email', $request->email)->first()->tokens()->delete();
        return response()->json(['
        message' => 'deconnexion réussie',
    ]);
    }
}
