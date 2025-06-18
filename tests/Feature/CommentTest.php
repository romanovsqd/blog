<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_leave_comment(): void
    {
        $post = Post::factory()->create();

        $response = $this->post(route('posts.comments.store', $post), ['body' => 'test comment']);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('comments', ['body' => 'test comment']);
    }

    public function test_unverified_user_cannot_leave_comment(): void
    {
        $user = User::factory()->unverified()->create();
        $post = Post::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('posts.comments.store', $post), ['body' => 'test comment']);

        $response->assertRedirect(route('verification.notice'));
        $this->assertDatabaseMissing('comments', ['body' => 'test comment']);
    }

    public function test_user_can_leave_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('posts.comments.store', $post), ['body' => 'test comment']);

        $response->assertRedirect(route('posts.show', $post));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('comments', ['body' => 'test comment']);
    }

    public function test_user_can_delete_own_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->for($user)->for($post)->create();

        $this->actingAs($user);

        $response = $this->delete(route('posts.comments.delete', [$post, $comment]));

        $response->assertRedirect(route('posts.show', $post));
        $response->assertSessionHas('error');

        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    public function test_user_cannot_delete_others_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->for($post)->create();

        $this->actingAs($user);

        $response = $this->delete(route('posts.comments.delete', [$post, $comment]));

        $response->assertStatus(403);

        $this->assertDatabaseHas('comments', ['id' => $comment->id]);
    }

    public function test_admin_can_delete_any_users_comment(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $post = Post::factory()->create();

        $comments = Comment::factory(3)->for($post)->create();

        $this->actingAs($user);

        foreach ($comments as $comment) {
            $response = $this->delete(route('posts.comments.delete', [$post, $comment]));
            $response->assertRedirect(route('posts.show', $post));
            $response->assertSessionHas('error');
            $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
        }
    }
}
