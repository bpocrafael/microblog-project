<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use App\Http\Requests\CreateUserRequest;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use InteractsWithDatabase;

    /** @test */
    public function test_valid_register_controller_test()
    {
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ];

        $request = new CreateUserRequest();
        $validator = validator($data, $request->rules(), $request->messages());

        $this->assertFalse($validator->fails());
    }

    /* @test */
    public function test_invalid_register_controller_test()
    {
        $data = [
            'first_name' => '',
            'last_name' => '',
            'username' => 'user@name',
            'email' => 'invalid-email',
            'password' => 'short',
            'password_confirmation' => 'password123',
        ];

        $request = new CreateUserRequest();
        $validator = validator($data, $request->rules(), $request->messages());

        $this->assertTrue($validator->fails());
    }
}
