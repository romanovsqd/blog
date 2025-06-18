<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_access_empty_category_list(): void
    {
        $response = $this->get(route('categories.index'));

        $response->assertStatus(200);
        $response->assertSee('No categories found');
    }

    public function test_guest_can_access_category_list(): void
    {
        $categories = Category::factory(3)->create();
        $response = $this->get(route('categories.index'));

        $response->assertStatus(200);

        foreach ($categories as $category) {
            $response->assertSee($category->name);
        }
    }

    public function test_guest_can_access_category(): void
    {
        $category = Category::factory()->create();
        $posts = Post::factory(3)->for($category)->create();

        $response = $this->get(route('categories.show', $category));

        $response->assertStatus(200);

        foreach ($posts as $post) {
            $response->assertSee($post->title);
        }
    }
}
