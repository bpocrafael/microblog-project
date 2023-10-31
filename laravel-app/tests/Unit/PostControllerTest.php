<?php

namespace Tests\Unit;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserPostRequest;
use App\Services\PostService;
use App\Services\RegistrationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\UserPost;
use Illuminate\Http\UploadedFile;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @var RegistrationService */
    protected $registrationService;

    /** @var CreateUserRequest */
    protected $createUserRequest;

    /** @var PostService */
    protected $postService;

    /** @var UserPostRequest */
    protected $userPostRequest;

    public function setUp(): void
    {
        $this->createUserRequest = new CreateUserRequest();
        $this->registrationService = new RegistrationService();
        $this->postService = new PostService();
        $this->userPostRequest = new UserPostRequest();

        parent::setUp();
    }

    /** @test */
    public function test_authenticated_user_can_create_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $postData = [
            'content' => 'Test post content',
        ];

        $validator = validator($postData, $this->userPostRequest->rules());

        $this->assertFalse($validator->fails());

        $this->postService->createPost($user, $postData);

        $this->assertDatabaseHas('user_posts', [
            'user_id' => $user->id,
            'content' => 'Test post content',
        ]);
    }

    /** @test */
    public function test_invalid_post_creation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'content' => '',
            'image' => 'non_existent_image.jpg',
        ];

        $validator = validator($data, $this->userPostRequest->rules());
        $this->assertTrue($validator->fails());

    }

    /** @test */
    public function test_authenticated_user_post_creation_requires_content()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('post.store'), [
            'content' => '',
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors('content');

        $this->assertDatabaseMissing('user_posts', [
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function test_unauthenticated_user_cannot_create_post()
    {
        $response = $this->post(route('post.store'), [
            'content' => 'Test post content',
        ]);

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function test_authenticated_user_can_update_post()
    {
        $user = User::factory()->create();
        $post = UserPost::factory()->create([
            'user_id' => $user->id,
            'content' => 'Original post content',
        ]);

        $this->actingAs($user);

        $updatedContent = 'Updated post content';

        $this->postService->updatePost($post, ['content' => $updatedContent]);

        $response = $this->put(route('post.update', ['post' => $post->id]), [
            'content' => $updatedContent,
        ]);

        $response->assertRedirect(route('post.show', ['post' => $post->id]));

        $this->assertDatabaseHas('user_posts', [
            'id' => $post->id,
            'user_id' => $user->id,
            'content' => $updatedContent,
        ]);
    }

    /** @test */
    public function test_authenticated_user_can_update_post_with_image()
    {
        $user = User::factory()->create();
        $post = UserPost::factory()->create([
            'user_id' => $user->id,
            'content' => 'Original post content',
        ]);

        $this->actingAs($user);

        $updatedImage = UploadedFile::fake()->image('updated_image.jpg');

        $updatedContent = 'Updated post content';

        $response = $this->put(route('post.update', ['post' => $post->id]), [
            'content' => $updatedContent,
            'image' => $updatedImage,
        ]);

        $response->assertRedirect(route('post.show', ['post' => $post->id]));

        $this->assertDatabaseHas('user_posts', [
            'id' => $post->id,
            'user_id' => $user->id,
            'content' => $updatedContent,
        ]);

        $this->assertDatabaseHas('post_media', [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'file_path' => 'images/' . $updatedImage->hashName(),
        ]);
    }

    /** @test */
    public function test_authenticated_user_can_delete_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = UserPost::factory()->create([
            'user_id' => $user->id,
            'content' => 'Content will be deleted',
        ]);

        $this->postService->deletePost($post);

        $this->assertSoftDeleted('user_posts', [
            'id' => $post->id,
        ]);
    }
}
