<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


// Utilizo 4 funciones para este proyecto: registro, login, perfil y logout


class UserController extends Controller
{
    
    public function register(Request $request)
    {

        // valido primero que los datos sean correctos
        $request->validate([

            'name' => 'required',

            'email' => 'required|email|unique:users',

            'password' => 'required|confirmed',

            'password_confirmation' => 'required|same:password'

        ]);

        // si los datos son correctos, se crea el registro
        $user = new User();

        $user->name = $request->name;

        $user->email = $request->email;

        $user->password = Hash::make($request->password);


        $user->save();


        // mensaje:

        return response()->json([

            "status" => 1,

            "msg" => "Registrado!"

        ]);


    }



    public function login(Request $request)
    {
        // validacion de que ingrese el email y la clave
        $request->validate([

            'email' => 'required|email',

            'password' => 'required'

        ]);


        // verifico que el usuario ya esta registrado
        // comparo el email ingresado
        $user = User::where("email", "=", $request->email)->first();

        // comparo
        // isset determina si una variable esta definida y no es del tipo null
        if (isset($user->id)) {
            
            if (Hash::check($request->password, $user->password)) 
            {
                
                // creo el token
                $token = $user->createToken("auth_token")->plainTextToken;

                return response()->json([

                    "status" => 1,

                    "msg" => "Logueado!",

                    "access_token" => $token

                ]);

            }else{
                // si la contraseña ingresada no es correcta
            
                return response()->json([

                    "status" => 0,

                    "msg" => "La clave es incorrecta"

                ], 404);
                
            }

            
        }else{
            // si el usuario no esta registrado
            return response()->json([

                "status" => 0,

                "msg" => "No estas registrado"

            ], 404);

        }

    }



    public function profile()
    {
        

    }



    public function logout()
    {
        

    }

}
