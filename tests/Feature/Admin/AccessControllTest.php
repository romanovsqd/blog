<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccessControllTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_routes(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('admin.posts.index'));
        $response->assertRedirect(route('login'));

        $response = $this->delete(route('admin.posts.delete', $post));
        $response->assertRedirect(route('login'));
    }

    public function test_user_cannot_access_admin_routes(): void
    {
        $post = Post::factory()->create();
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user);

        $response = $this->get(route('admin.posts.index'));
        $response->assertStatus(403);

        $response = $this->delete(route('admin.posts.delete', $post));
        $response->assertStatus(403);
    }

    public function test_unverified_admin_cannot_access_admin_routes(): void
    {
        $post = Post::factory()->create();
        $user = User::factory()->unverified()->create(['role' => 'admin']);

        $this->actingAs($user);

        $response = $this->get(route('admin.posts.index'));
        $response->assertRedirect(route('verification.notice'));

        $response = $this->delete(route('admin.posts.delete', $post));
        $response->assertRedirect(route('verification.notice'));
    }

    public function test_admin_can_access_admin_route(): void
    {
        $post = Post::factory()->create();
        $user = User::factory()->create(['role' => 'admin']);

        $this->actingAs($user);

        $response = $this->get(route('admin.posts.index'));
        $response->assertStatus(200);

        $response = $this->delete(route('admin.posts.delete', $post));
        $response->assertRedirect(route('admin.posts.index'));

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
