<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use DatabaseTruncation;

    const BASE_URL = '/api/auth';
    public function testRegisterSuccesful(): void
    {
        $user = [
            'username' => 'luisapata',
            'email' => 'dev.luis.zapata@gmail.com',
            'password' => 'Luis#200315'
        ];

        $response = $this->postJson( self::BASE_URL . '/register', [
            'username' => $user['username'],
            'email' => $user['email'],
            'password' => $user['password'],
            'password_confirmation' => $user['password']
        ]);

        $response->assertStatus(201)
            ->assertExactJson([
                'status' => 'success',
                'message' => 'Usuario registrado correctamente',
                'data' => [
                    'id' => 1,
                    'username' => $user['username'],
                    'email' => $user['email'],
                ],
                'token' => null
            ]);
    }

    public function testRegisterFailed(): void
    {
        $user = [];

        $response = $this->postJson( self::BASE_URL . '/register', $user);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'status',
                'message',
                'errors'
            ]);
    }

    public function testLoginSuccesful(): void
    {
        $user = User::factory()->create([
            USER::EMAIL => 'luiszapata@gmail.com',
            USER::PASSWORD => Hash::make('Luis#200315')
        ]);

        $response = $this->postJson( self::BASE_URL . '/login', [
            'email' => $user->{USER::EMAIL},
            'password' => 'Luis#200315'
        ]);

        $token = $response->json('token');
        $verified = $response->json('data.email_verified_at');

        $response->assertStatus(200)
            ->assertExactJson([
                'status' => 'success',
                'message' => 'Sesión iniciada correctamente',
                'data' => [
                    'id' => 1,
                    'username' => $user->{USER::USERNAME},
                    'email' => $user->{USER::EMAIL},
                    'email_verified_at' => $verified
                ],
                'token' => $token
            ]);
    }

    public function testLoginFailed(): void
    {
        $response = $this->postJson( self::BASE_URL . '/login', [
            'email' => 'luis@gmail.com',
            'password' => 'Luis#200315'
        ]);

        $response->assertStatus(401)
            ->assertExactJson([
                'status' => 'error',
                'message' => 'Credenciales de usuario incorrectas',
                'errors' => null
            ]);
    }
}
