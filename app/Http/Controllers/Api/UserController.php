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
        

    }



    public function profile()
    {
        

    }



    public function logout()
    {
        

    }

}
