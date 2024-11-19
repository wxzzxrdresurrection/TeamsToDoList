<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\RandomCharacterGenerator;
use App\Jobs\Mailer;
use App\Models\User;
use App\Validators\RequestValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = RequestValidator::validateUserRequest($request);

        if (!$validator->isEmpty())
        {
            return ApiResponse::error('Errores de validación', $validator->messages(), 422);
        }

        $user = User::create([
            User::USERNAME => $request->username,
            User::EMAIL => $request->email,
            User::PASSWORD => Hash::make($request->password)
        ]);

        return ApiResponse::success('Usuario registrado correctamente', $user, null, 201);
    }

    public function login(Request $request)
    {
        $validator = RequestValidator::validateLoginRequest($request);

        if (!$validator->isEmpty())
        {
            return ApiResponse::error('Errores de validación', $validator->messages(), 422);
        }

        $user = User::where(User::USERNAME, $request->username)
            ->orWhere(User::EMAIL, $request->email)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password))
        {
            return ApiResponse::error('Credenciales de usuario incorrectas', null, 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return ApiResponse::success('Sesión iniciada correctamente', $user, $token, 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if (!$user)
        {
            return ApiResponse::error('Usuario no encontrado', null, 404);
        }

        $user->currentAccessToken()->delete();
        return ApiResponse::success('Sesión cerrada correctamente');
    }

    public function profile(Request $request)
    {
        $user = $request->user();

        if (!$user)
        {
            return ApiResponse::error('Usuario no encontrado', null, 404);
        }

        return ApiResponse::success('Usuario encontrado exitosamente', $user);
    }

    public function recoverPassword(Request $request)
    {
        $validator = RequestValidator::validateEmailRequest($request);

        if (!$validator->isEmpty())
        {
            return ApiResponse::error('Errores de validación', $validator->messages(), 422);
        }

        $user = User::where(User::EMAIL, $request->email)->first();

        if (!$user)
        {
            return ApiResponse::error('Usuario no encontrado', null, 404);
        }

        $newPassword = RandomCharacterGenerator::generate(12, true, true, true, true);
        $user->password = Hash::make($newPassword);
        $user->save();

        Mailer::dispatch($user->email, $user->username, $newPassword)
            ->delay(now()->addSeconds(10))
            ->onConnection('database')
            ->onQueue('mails');

        return ApiResponse::success('Email de recuperación de contraseña enviado correctamente');
    }
}
