<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Validators\RequestValidator;
use Illuminate\Http\Request;

class RequestValidatorTest extends TestCase
{
    public function testSuccessfullValidation(): void
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

    public function testFailedValidation(): void
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
}
