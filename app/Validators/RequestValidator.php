<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestValidator {

    public static function validateTeamRequest(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'owner_id' => 'required|integer',
        ],[
            'required' => 'El nombre es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute no debe superar mas de :max caracteres.',
            'owner_id.exists' => 'El usuario no existe.',
        ]);

        return $validator->errors();
    }

}

