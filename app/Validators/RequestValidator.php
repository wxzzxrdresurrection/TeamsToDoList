<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestValidator
{
    public static function validateUserRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:40|unique:users|regex:/^[a-z0-9_]+$/',
            'email' => 'required|string|email:rfs,dns|max:120|unique:users',
            'password' => 'required|string|min:8|max:30|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&()_+\[\]{}*])[A-Za-z\d!@#$%^&()_+\[\]{}*]{8,}$/',
            'password_confirmation' => 'required|string|min:8|max:30|same:password',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute puede contener un máximo de :max caracteres.',
            'unique' => 'El campo :attribute ya se encuentra en uso.',
            'email' => 'El campo :attribute debe ser un email válido.',
            'min' => 'El campo :attribute debe contener un mínimo de :min caracteres.',
            'same' => 'Las contraseñas no coinciden.',
            'username.regex' => 'El campo :attribute solo puede contener letras minúsculas, números y guiones bajos.',
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una minúscula, un número y un carácter especial.',
        ]);

        return $validator->errors();
    }

    public static function validateLoginRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'nullable|string|max:40|regex:/^[a-z0-9_]+$/',
            'email' => 'nullable|string|email:rfs,dns|max:120',
            'password' => 'required|string|min:8|max:30|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&()_+\[\]{}*])[A-Za-z\d!@#$%^&()_+\[\]{}*]{8,}$/',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute puede contener un máximo de :max caracteres.',
            'email' => 'El campo :attribute debe ser un email válido.',
            'min' => 'El campo :attribute debe contener un mínimo de :min caracteres.',
            'username.regex' => 'El campo :attribute solo puede contener letras minúsculas, números y guiones bajos.',
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una minúscula, un número y un carácter especial.',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (!$request->has('username') && !$request->has('email')) {
                $validator->errors()->add('username_or_email', 'Se debe proporcionar un username o email.');
            }
        });

        return $validator->errors();
    }

    public static function validateEmailRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email:rfs,dns|max:120',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'email' => 'El campo :attribute debe ser un email válido.',
            'max' => 'El campo :attribute puede contener un máximo de :max caracteres.',
        ]);

        return $validator->errors();
    }

    public static function validateSearchRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_text' => 'required|string',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
        ]);

        return $validator->errors();
    }

    public static function validateUserId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'exists' => 'El campo :attribute no existe.',
        ]);

        return $validator->errors();
    }

    public static function validatePasswordRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'actual_password' => 'required|string|min:8|max:30',
            'password' => 'required|string|min:8|max:30|different:actual_password|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&()_+\[\]{}*])[A-Za-z\d!@#$%^&()_+\[\]{}*]{8,}$/',
            'password_confirmation' => 'required|string|min:8|max:30|same:password',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'min' => 'El campo :attribute debe contener un mínimo de :min caracteres.',
            'max' => 'El campo :attribute puede contener un máximo de :max caracteres.',
            'same' => 'Las contraseñas no coinciden.',
            'different' => 'La nueva contraseña tiene que ser diferente a la actual.',
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una minúscula, un número y un carácter especial.',
        ]);

        return $validator->errors();
    }

    public static function validateTeamRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            // 'icon' => 'required|string'
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute puede contener un máximo de :max caracteres.',
        ]);

        return $validator->errors();
    }

    public static function validateTeamCodeRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:7|min:7|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{7,}$/'
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute puede contener un máximo de :max caracteres.',
            'min' => 'El campo :attribute debe contener un mínimo de :min caracteres.',
            'regex' => 'El campo :attribute debe contener al menos una letra mayúscula, una minúscula y un número.'
        ]);

        return $validator->errors();
    }

    public static function validateTaskRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'body' => 'required|string|max:255',
            'responsible_id' => 'required|integer|exists:users,id',
            'team_id' => 'required|integer|exists:teams,id',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute puede contener un máximo de :max caracteres.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'exists' => 'El campo :attribute no existe.',
        ]);

        return $validator->errors();
    }

    public static function validateUserTaskRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'body' => 'required|string|max:255',
            'team_id' => 'required|integer|exists:teams,id',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute puede contener un máximo de :max caracteres.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'exists' => 'El campo :attribute no existe.',
        ]);

        return $validator->errors();
    }
}
