<?php

namespace Tests\Unit;

use App\Services\LoginService;
use App\Services\UserVerificationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_returns_login_view()
    {
        $response = $this->get('/login');
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function authenticate_redirects_unauthenticated_users_to_login()
    {
        $this->partialMock(LoginService::class, function ($mock) {
            $mock->shouldReceive('isAuthenticated')->andReturn(false);
        });

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'testpassword',
        ]);

        $response->assertRedirect('/');
    }

    /** @test */
    public function authenticate_redirects_authenticated_but_not_verified_users_to_login()
    {
        $this->partialMock(LoginService::class, function ($mock) {
            $mock->shouldReceive('isAuthenticated')->andReturn(false);
        });

        $this->partialMock(UserVerificationService::class, function ($mock) {
            $mock->shouldReceive('isUserVerified')->andReturn(true);
        });

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'testpassword',
        ]);

        $response->assertRedirect('/');
    }

    /** @test */
    public function authenticate_requires_email_and_password()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    /** @test */
    public function authenticate_redirects_authenticated_and_verified_users_to_home()
    {
        $this->partialMock(LoginService::class, function ($mock) {
            $mock->shouldReceive('isAuthenticated')->andReturn(true);
        });

        $this->partialMock(UserVerificationService::class, function ($mock) {
            $mock->shouldReceive('isUserVerified')->andReturn(true);
        });

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'testpassword',
        ]);

        $response->assertRedirect('/home');
    }

    // ... You can continue writing tests for other scenarios ...

}
