<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\User;
use App\Validators\RequestValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function findAll()
    {
        $users = User::all();
        return ApiResponse::success('Usuarios encontrados correctamente', $users, null, 200);
    }

    public function findOne(int $id)
    {
        $user = User::find($id);

        if (!$user)
        {
            return ApiResponse::error('Usuario no encontrado', null, 404);
        }

        return ApiResponse::success('Usuario encontrado correctamente', $user, null, 200);
    }

    public function searchForUser(Request $request)
    {
        $validator = RequestValidator::validateSearchRequest($request);
        if (!$validator->isEmpty())
        {
            return ApiResponse::error('Errores de validación', $validator->messages(), 422);
        }

        $users = User::where(User::USERNAME, 'like', '%' . $request->username . '%')
            ->orWhere(User::EMAIL, 'like', '%' . $request->email . '%')
            ->get();

        return ApiResponse::success('Usuarios encontrados correctamente', $users, null, 200);
    }

    public function updatePassword(Request $request)
    {
        $validator = RequestValidator::validatePasswordRequest($request);
        if (!$validator->isEmpty())
        {
            return ApiResponse::error('Errores de validación', $validator->messages(), 422);
        }

        $user = $request->user();
        if (!$user)
        {
            return ApiResponse::error('Usuario no encontrado', null, 404);
        }

        if (!Hash::check($request->actual_password, $user->password))
        {
            return ApiResponse::error('La contraseña actual es incorrecta', null, 401);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return ApiResponse::success('Contraseña actualizada correctamente', $user, null, 200);
    }
}
