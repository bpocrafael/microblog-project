<?php

namespace Tests\Unit;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\UserPostRequest;
use App\Models\User;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use WithFaker;

    /** @var CommentService */
    protected $commentService;

    /** @var PostService */
    protected $postService;

    /** @var UserPostRequest */
    protected $userPostRequest;

    /** @var CommentRequest */
    protected $commentRequest;

    public function setUp(): void
    {
        parent::setUp();
        $this->userPostRequest = new UserPostRequest();
        $this->commentRequest = new CommentRequest();
        $this->commentService = new CommentService();
        $this->postService = new PostService();
    }

    /** @test */
    public function test_user_required_comment_field()
    {
        $validator = validator(['comment' => ''], $this->commentRequest->rules());

        $this->assertTrue($validator->fails());
    }

    /** @test */
    public function test_user_max_characters_comment_field()
    {
        $comment = str_repeat('a', 256);
        $validator = validator(['comment' => $comment], $this->commentRequest->rules());

        $this->assertTrue($validator->fails());
    }

    /** @test */
    public function test_user_can_add_comment()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $postContent = 'Test post content';
        $userPost = $this->postService->createPost($user, ['content' => $postContent]);
        $commentData = [
            'comment' => 'This is a comment.',
        ];

        $commentRequest = new CommentRequest($commentData);
        $result = $this->commentService->storeComment($commentRequest, $userPost);

        $this->assertEquals('Comment added successfully', $result['message']);
        $this->assertNotNull($result['comment']);
        $this->assertEquals($commentData['comment'], $result['comment']->comment);
        $this->assertEquals($userPost->id, $result['comment']->post_id);
        $this->assertEquals($user->id, $result['comment']->user_id);
    }

    /** @test */
    public function test_user_can_delete_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $postContent = 'Test post content';
        $userPost = $this->postService->createPost($user, ['content' => $postContent]);
        $commentData = [
            'comment' => 'Owned comment',
        ];

        $validator = validator(['comment' => $commentData], $this->commentRequest->rules());

        $this->assertFalse($validator->fails());

        $commentRequest = new CommentRequest($commentData);
        $result = $this->commentService->storeComment($commentRequest, $userPost);

        $this->assertEquals('Comment added successfully', $result['message']);
        $this->assertNotNull($result['comment']);

        $result = $this->commentService->deleteComment($result['comment']->id);

        $this->assertEquals("Comment deleted from {$user->username}'s post", $result['message']);
    }

    /** @test */
    public function test_user_can_only_delete_owned_comment()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($user);

        $postContent = 'Test post content';
        $userPost = $this->postService->createPost($user, ['content' => $postContent]);
        $commentData = [
            'comment' => 'Non-owned comment',
        ];

        $validator = validator(['comment' => $commentData], $this->commentRequest->rules());

        $this->assertFalse($validator->fails());

        $commentRequest = new CommentRequest($commentData);
        $result = $this->commentService->storeComment($commentRequest, $userPost);

        $this->assertEquals('Comment added successfully', $result['message']);
        $this->assertNotNull($result['comment']);

        $otherUserComment = $this->commentService->storeComment(new CommentRequest(['comment' => 'Non-owned comment by other user']), $userPost);

        $this->commentService->deleteComment($otherUserComment['comment']->id);
        $this->assertDatabaseHas('post_comments', [
            'id' => $result['comment']->id,
            'comment' => $commentData['comment'],
        ]);
    }

    /** @test */
    public function test_user_can_edit_owned_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $postContent = 'Test post content';
        $userPost = $this->postService->createPost($user, ['content' => $postContent]);
        $commentData = [
            'comment' => 'Owned comment',
        ];

        $validator = validator(['comment' => $commentData], $this->commentRequest->rules());
        $this->assertFalse($validator->fails());

        $commentRequest = new CommentRequest($commentData);
        $result = $this->commentService->storeComment($commentRequest, $userPost);

        $this->assertEquals('Comment added successfully', $result['message']);
        $this->assertNotNull($result['comment']);

        $editedCommentData = 'Edited owned comment';
        $result = $this->commentService->editComment($result['comment']->id, $editedCommentData);

        $this->assertEquals('Comment edited successfully', $result['message']);
        $this->assertEquals('Edited owned comment', $result['comment']);
    }

    /** @test */
    public function test_user_can_only_edit_owned_comment()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($user);

        $postContent = 'Test post content';
        $userPost = $this->postService->createPost($user, ['content' => $postContent]);
        $commentData = [
            'comment' => 'Non-owned comment',
        ];

        $validator = validator(['comment' => $commentData], $this->commentRequest->rules());

        $this->assertFalse($validator->fails());

        $commentRequest = new CommentRequest($commentData);
        $result = $this->commentService->storeComment($commentRequest, $userPost);

        $this->assertEquals('Comment added successfully', $result['message']);
        $this->assertNotNull($result['comment']);

        $otherUserComment = $this->commentService->storeComment(new CommentRequest(['comment' => 'Non-owned comment by other user']), $userPost);
        $editedCommentData = 'Edited non-owned comment';

        $this->commentService->editComment($otherUserComment['comment']->id, $editedCommentData);
        $this->assertDatabaseHas('post_comments', [
            'id' => $result['comment']->id,
            'comment' => $commentData['comment'],
        ]);
    }
}
