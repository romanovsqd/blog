<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostManagmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_post(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $postData = [
            'title' => 'Test post title',
            'content' => 'Test post content',
            'category_id' => $category->id,
        ];

        $this->actingAs($user);

        $response = $this->post(route('admin.posts.store'), $postData);

        $response->assertRedirect(route('admin.posts.index'));
        $response->assertSessionHas('success');

        $postData['user_id'] = $user->id;

        $this->assertDatabaseHas('posts', $postData);
    }

    public function test_admin_can_edit_post(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $post = Post::factory()->for($user)->create();
        $category = Category::factory()->create();

        $postData = [
            'title' => 'changed title',
            'content' => 'changed content',
            'category_id' => $category->id,
        ];

        $this->actingAs($user);

        $response = $this->put(route('admin.posts.update', $post), $postData);

        $response->assertRedirect(route('admin.posts.index'));
        $response->assertSessionHas('success');

        $postData['id'] = $post->id;

        $this->assertDatabaseHas('posts', $postData);
    }

    public function test_admin_can_delete_post(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $post = Post::factory()->for($user)->create();

        $this->actingAs($user);

        $response = $this->delete(route('admin.posts.delete', $post));

        $response->assertRedirect(route('admin.posts.index'));
        $response->assertSessionHas('error');

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_admin_can_view_post_list(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $posts = Post::factory(3)->create();

        $this->actingAs($user);

        $response = $this->get(route('admin.posts.index'));

        $response->assertStatus(200);

        foreach ($posts as $post) {
            $response->assertSee($post->title);
        }
    }
}
