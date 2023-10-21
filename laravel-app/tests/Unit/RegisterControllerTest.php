<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use App\Http\Requests\CreateUserRequest;
use App\Mail\EmailVerificationMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use InteractsWithDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Mail::fake();
    }

    protected function assertEmailSent($email)
    {
        Mail::assertSent(EmailVerificationMail::class, function ($mail) use ($email) {
            return $mail->hasTo($email);
        });
    }

    protected function registerUser($userData)
    {
        $user = User::create([
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'username' => $userData['username'],
            'email_verification_code' => Str::random(40),
        ]);

        $user->information()->create([
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
        ]);

        Mail::to($userData['email'])->send(new EmailVerificationMail($user));
    }

    /** @test */
    public function test_user_to_register_form_view()
    {
        $response = $this->get('/register');
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function test_user_valid_registration_test()
    {
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'Secret123@Pass',
            'password_confirmation' => 'Secret123@Pass',
        ];

        $request = new CreateUserRequest();
        $validator = validator($data, $request->rules(), $request->messages());

        $this->assertFalse($validator->fails());

        $this->registerUser($data);

        $this->assertEmailSent($data['email']);
    }

    /* @test */
    public function test_user_invalid_registration_test()
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

    public function test_user_email_was_sent_after_registration()
    {
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'Secret123@Pass',
            'password_confirmation' => 'Secret123@Pass',
        ];

        $request = new CreateUserRequest();
        $validator = validator($data, $request->rules(), $request->messages());

        $this->assertFalse($validator->fails());

        $this->registerUser($data);

        $this->assertEmailSent($data['email']);
    }

    /** @test */
    public function test_user_email_not_sent_for_invalid_or_existing_email()
    {
        $responseInvalidEmail = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $responseInvalidEmail->assertSessionMissing('status');

        $responseExistingEmail = $this->post('/register', [
            'name' => 'Another User',
            'email' => 'existing@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $responseExistingEmail->assertSessionMissing('status');
    }

    /** @test */
    public function test_user_redirected_to_login_after_email_verification_was_sent()
    {
        $user = User::create([
            'username' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'email_verification_code' => 'sample_verification_code',
        ]);

        $verificationUrl = route('verify-email', ['verification_code' => $user->email_verification_code]);

        $response = $this->get($verificationUrl);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function test_user_redirected_to_resend_email_if_unverified_email_on_login()
    {
        User::create([
            'username' => 'Unverified User',
            'email' => 'unverified@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => null,
        ]);

        $response = $this->post('/login', [
            'email' => 'unverified@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('register/resend');
    }

    /** @test */
    public function test_user_redirected_to_login_after_resending_email()
    {
        $user = User::create([
            'username' => 'Unverified User',
            'email' => 'unverified@example.com',
            'password' => bcrypt('password'),
            'email_verification_code' => 'sample_verification_code',
            'email_verified_at' => null,
        ]);

        $response = $this->post('/login', [
            'email' => 'unverified@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/register/resend');

        $response = $this->get('/register/resend');

        $response->assertViewIs('auth.resend');

        $response = $this->post('/register/resend', [
            'email-resend' => 'unverified@example.com',
        ]);

        Mail::assertSent(EmailVerificationMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });

        $response->assertRedirect('/login');
    }

    /** @test */
    public function test_user_resend_email_error_if_already_verified_or_non_existent_email()
    {
        User::create([
            'username' => 'Verified User',
            'email' => 'verified@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $responseVerified = $this->post('/register/resend', [
            'email-resend' => 'verified@example.com',
        ]);

        $responseVerified->assertSessionHas('error', 'Email doesn\'t exist in the database or is already verified');

        $responseNonExistent = $this->post('/register/resend', [
            'email-resend' => 'nonexistent@example.com',
        ]);

        $responseNonExistent->assertSessionHas('error', 'Email doesn\'t exist in the database or is already verified');
    }

    /** @test */
    public function test_user_redirected_to_resend_with_error_on_outdated_verification_code()
    {
        User::create([
            'username' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'email_verification_code' => 'verification_code',
            'email_verified_at' => null,
        ]);

        $response = $this->get(route('verify-email', ['verification_code' => 'sample_outdated_verification_code']));

        $response->assertRedirect(route('resend'));
        $response->assertSessionHas('error', 'Verification link expired or email already verified');
    }
}
