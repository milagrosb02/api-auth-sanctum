<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Log;

// Utilizo 4 funciones para este proyecto: registro, login, perfil y logout


class UserController extends Controller
{
      
      public function register(RegisterRequest $request)
    {
        try {
            $validated = $request->validated();

            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return response()->json([
                "status" => 1,
                "msg" => "¡Registrado correctamente!"
            ]);
        } catch (\Throwable $th) {
            Log::error("Error en registro: " . $th->getMessage());
            return response()->json([
                "status" => 0,
                "msg" => "Hubo un error al registrarse."
            ], 500);
        }
    }
   

     public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where("email", $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                $token = $user->createToken("auth_token")->plainTextToken;

                return response()->json([
                    "status" => 1,
                    "msg" => "¡Logueado con éxito!",
                    "access_token" => $token
                ]);
            }

            return response()->json([
                "status" => 0,
                "msg" => $user ? "La clave es incorrecta" : "No estás registrado"
            ], 401);
        } catch (\Throwable $th) {
            Log::error("Error en login: " . $th->getMessage());
            return response()->json([
                "status" => 0,
                "msg" => "Hubo un error al iniciar sesión."
            ], 500);
        }
    }



    public function profile(Request $request)
    {
        try {
            return response()->json([
                "status" => 1,
                "msg" => "Perfil del usuario",
                "data" => $request->user()
            ]);
        } catch (\Throwable $th) {
            Log::error("Error en perfil: " . $th->getMessage());
            return response()->json([
                "status" => 0,
                "msg" => "Hubo un error al obtener el perfil."
            ], 500);
        }
    }



    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();

            return response()->json([
                "status" => 1,
                "msg" => "¡Sesión cerrada con éxito!"
            ]);
        } catch (\Throwable $th) {
            Log::error("Error en logout: " . $th->getMessage());
            return response()->json([
                "status" => 0,
                "msg" => "Hubo un error al cerrar sesión."
            ], 500);
        }
    }

}
