<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
   

    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return 
        [
            'name' => 'required',

            'email' => 'required|email|unique:users',

            'password' => 'required|confirmed',

            'password_confirmation' => 'required|same:password'
        ];
    }


    public function messages()
    {
       return[

            'required' => 'El campo :attribute es obligatorio. ',

            'unique' => 'El :attribute ya está en uso.',

            'email' => 'El formato del :attribute no es válido.',

            'confirmed' => 'La confirmación de :attribute no coincide.',
            
            'same' => 'Los campos :attribute y :other deben coincidir.'

       ];
    }


}
