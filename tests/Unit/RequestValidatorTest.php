<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Validators\RequestValidator;
use Illuminate\Http\Request;

class RequestValidatorTest extends TestCase
{
    public function testSuccessfulTeamlValidation(): void
    {
        $request = new Request();
        $request->replace([
            'name' => 'Team 1',
            'description' => 'This is a team',
            'icon' => 'icon.png',
            'owner_id' => 1
        ]);

        $validator = RequestValidator::validateTeamRequest($request);

        $this->assertCount(0, $validator);
        $this->assertEmpty($validator);
    }

    public function testFailedTeamValidation(): void
    {
        $request = new Request();
        $request->replace([
            'name' => '',
            'description' => 'This is a team',
            'icon' => 'icon.png',
            'owner_id' => 1
        ]);

        $validator = RequestValidator::validateTeamRequest($request);

        $this->assertCount(1, $validator);
        $this->assertNotEmpty($validator);
    }

    public function testSuccessfulUserValidation(): void
    {
        $request = new Request();
        $request->replace([
            'username' => 'marston97',
            'email' => 'marston@gmail.com',
            'password' => 'Marston97!',
            'password_confirmation' => 'Marston97!'
        ]);

        $validator = RequestValidator::validateUserRequest($request);

        $this->assertCount(0, $validator);
        $this->assertEmpty($validator);
    }

    public function testFailedUserValidation(): void
    {
        $request = new Request();
        $request->replace([
            'username' => 'marston97',
            'email' => '',
            'password' => 'Marston97',
            'password_confirmation' => 'Marston97'
        ]);

        $validator = RequestValidator::validateUserRequest($request);

        $this->assertCount(2, $validator);
        $this->assertNotEmpty($validator);
    }

    public function testCorrectUserValidation(): void
    {
        $request = new Request();
        $request->replace([
            'username' => 'marston97',
            'email' => ' ',
            'password' => 'Marston97',
            'password_confirmation' => 'Marston97'
        ]);

        $expectedValidationMessages = [
            'email' => ['El campo email es obligatorio.'],
            'password' => ['La contraseña debe contener al menos una letra mayúscula, una minúscula, un número y un carácter especial.']
        ];

        $validator = RequestValidator::validateUserRequest($request);

        $this->assertCount(2, $validator);
        $this->assertNotEmpty($validator);
        $this->assertEquals($expectedValidationMessages, $validator->messages());
    }

    public function testSuccessfulEmailValidation(): void
    {
        $request = new Request();
        $request->replace([
            'email' => 'luiszapata@gmail.com'
        ]);

        $validator = RequestValidator::validateEmailRequest($request);

        $this->assertCount(0, $validator);
        $this->assertEmpty($validator);
    }

    public function testCorrectEmailValidation(): void
    {
        $request = new Request();
        $request->replace([
            'email' => ''
        ]);

        $expectedValidationMessages = [
            'email' => ['El campo email es obligatorio.']
        ];

        $validator = RequestValidator::validateEmailRequest($request);

        $this->assertCount(1, $validator);
        $this->assertNotEmpty($validator);
        $this->assertEquals($expectedValidationMessages, $validator->messages());
    }

    public function testCorrectSearchValidation(): void
    {
        $request = new Request();
        $request->replace([
            'search_text' => ''
        ]);

        $expectedValidationMessages = [
            'search_text' => ['El campo search text es obligatorio.']
        ];

        $validator = RequestValidator::validateSearchRequest($request);

        $this->assertCount(1, $validator);
        $this->assertNotEmpty($validator);
        $this->assertEquals($expectedValidationMessages, $validator->messages());
    }

    public function testSuccessfulSearchValidation(): void
    {
        $request = new Request();
        $request->replace([
            'search_text' => 'Luis Zapata'
        ]);

        $validator = RequestValidator::validateSearchRequest($request);

        $this->assertCount(0, $validator);
        $this->assertEmpty($validator);
    }

    public function testCorrectUserIdValidation(): void
    {
        $request = new Request();
        $request->replace([
            'user_id' => ''
        ]);

        $expectedValidationMessages = [
            'user_id' => ['El campo user id es obligatorio.']
        ];

        $validator = RequestValidator::validateUserId($request);

        $this->assertCount(1, $validator);
        $this->assertNotEmpty($validator);
        $this->assertEquals($expectedValidationMessages, $validator->messages());
    }

    public function testCorrectPasswordValidation(): void
    {
        $request = new Request();
        $request->replace([
            'actual_password' => 'Marston97!',
            'password' => 'Marston97#',
            'password_confirmation' => 'Marston97$'
        ]);

        $expectedValidationMessages = [
            'password_confirmation' => ['Las contraseñas no coinciden.']
        ];

        $validator = RequestValidator::validatePasswordRequest($request);

        $this->assertCount(1, $validator);
        $this->assertNotEmpty($validator);
        $this->assertEquals($expectedValidationMessages, $validator->messages());
    }

    public function testSuccessfulPasswordValidation(): void
    {
        $request = new Request();
        $request->replace([
            'actual_password' => 'Marston97!',
            'password' => 'Marston97#',
            'password_confirmation' => 'Marston97#'
        ]);

        $validator = RequestValidator::validatePasswordRequest($request);

        $this->assertCount(0, $validator);
        $this->assertEmpty($validator);
    }


}
