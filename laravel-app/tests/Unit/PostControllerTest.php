<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('post.store'), [
            'content' => 'Test post content',
        ]);

        $response->assertRedirect(route('post.show', ['post' => 1]));
        $this->assertDatabaseHas('user_posts', [
            'user_id' => $user->id,
            'content' => 'Test post content',
        ]);
    }

    public function test_unauthenticated_user_cannot_create_post()
    {
        $response = $this->post(route('post.store'), [
            'content' => 'Test post content',
        ]);

        $response->assertRedirect(route('login'));
    }

}
