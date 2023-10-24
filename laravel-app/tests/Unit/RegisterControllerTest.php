<?php

namespace Tests\Unit;

use App\Services\RegistrationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use App\Http\Requests\CreateUserRequest;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\assertTrue;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use InteractsWithDatabase;

    /** @var RegistrationService */
    protected $registrationService;

    /** @var CreateUserRequest */
    protected $createUserRequest;

    public function setUp(): void
    {
        $this->createUserRequest = new CreateUserRequest();
        $this->registrationService = new RegistrationService();

        parent::setUp();
        Mail::fake();
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

        $validator = validator($data, $this->createUserRequest->rules(), $this->createUserRequest->messages());

        $this->assertFalse($validator->fails());

        $this->registrationService->registerUser($data);

        $this->assertDatabaseHas('users', [
            'username' => $data['username'],
            'email' => $data['email'],
        ]);

        $this->assertDatabaseHas('user_information', [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
        ]);

        $this->assertCredentials([
            'username' => $data['username'],
            'password' => $data['password'],
        ]);

    }

    /* @test */
    public function test_user_invalid_registration_test()
    {
        $data = [
            'first_name' => '',
            'last_name' => '',
            'username' => '',
            'email' => 'invalidEmail@example.com',
            'password' => 'ValidPass',
            'password_confirmation' => 'ValidPass',
        ];

        $validator = validator($data, $this->createUserRequest->rules(), $this->createUserRequest->messages());
        $this->assertTrue($validator->fails());
    }

    /** @test */
    public function test_user_email_was_sent_after_registration()
    {
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'Secret123@Pass',
            'password_confirmation' => 'Secret123@Pass',
            'email_verification_code' => 'valid_verification_code',
        ];

        $this->registrationService->registerUser($data);
        $this->registrationService->verifyEmail($data['email_verification_code']);

        Mail::assertSent(EmailVerificationMail::class, function ($mail) use ($data) {
            return $mail->hasTo($data['email']);
        });

    }

    /** @test */
    public function test_user_email_not_sent_for_invalid_email()
    {
        $data = [
            'email' => 'invalid_email',
        ];

        $this->registrationService->verifyEmail($data['email']);

        Mail::assertNotSent(EmailVerificationMail::class);
    }

    /** @test */
    public function test_user_email_not_sent_for_exsisting_email()
    {
        $existingEmail = 'existing@example.com';
        $verificationCode = 'valid_verification_code';

        $this->post('/register', [
            'name' => 'Existing User',
            'email' => $existingEmail,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->registrationService->verifyEmail($verificationCode);

        Mail::assertNotSent(EmailVerificationMail::class);
    }

    /** @test */
    public function test_user_redirected_to_login_after_email_verification_was_sent()
    {
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'Secret123@Pass',
            'password_confirmation' => 'Secret123@Pass',
            'verification_code' => 'redirect_to_login',
        ];

        $this->registrationService->registerUser($data);
        $this->registrationService->verifyEmail($data['verification_code']);

        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_user_redirected_to_resend_email_if_unverified_email_on_login()
    {
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'Secret123@Pass',
            'password_confirmation' => 'Secret123@Pass',
        ];

        $this->registrationService->registerUser($data);

        $response = $this->post('/login', [
            'email' => $data['email'],
            'password' => 'Secret123@Pass',
        ]);

        $response->assertRedirect('/register/resend');
    }

    /** @test */
    public function test_user_redirected_to_login_after_resending_email()
    {
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'Secret123@Pass',
            'password_confirmation' => 'Secret123@Pass',
        ];

        $this->registrationService->registerUser($data);

        $email = $data['email'];

        assertTrue($this->registrationService->resendEmail($email));

        $response = $this->post('register/resend', [
            'email-resend' => $email,
        ]);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function test_user_resend_email_error_if_already_verified_or_non_existent_email()
    {
        $data = [
             'first_name' => 'Verified',
             'last_name' => 'User',
             'username' => 'Verified User',
             'email' => 'verified@example.com',
             'password' => bcrypt('password'),
             'email_verified_at' => now(),
         ];

        $responseVerified = $this->post('/register/resend', [
            'email-resend' => $data['email'],
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
        $data = [
            'first_name' => 'Outdated',
            'last_name' => 'Veri Code',
            'username' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'email_verification_code' => 'verification_code',
            'email_verified_at' => null,
        ];

        $this->registrationService->registerUser($data);

        $this->registrationService->verifyEmail('sample_outdated_verification_code');

        $response = $this->get(route('verify-email', ['verification_code' => 'sample_outdated_verification_code']));

        $response->assertRedirect(route('resend'));
        $response->assertSessionHas('error', 'Verification link expired or email already verified');
    }
}
