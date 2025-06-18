<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_access_empty_post_list(): void
    {
        $response = $this->get(route('posts.index'));

        $response->assertStatus(200);
        $response->assertSee('No posts found');
    }

    public function test_guest_can_access_post_list(): void
    {
        $posts = Post::factory(3)->create();
        $response = $this->get(route('posts.index'));

        $response->assertStatus(200);

        foreach ($posts as $post) {
            $response->assertSee($post->title);
        }
    }

    public function test_guest_can_access_post(): void
    {
        $post = Post::factory()->create();
        $response = $this->get(route('posts.show', $post));

        $response->assertStatus(200);
        $response->assertSee($post->title);
    }
}
