<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryManagmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_category(): void
    {
        $user = User::factory()->create(['role' => 'admin']);

        $this->actingAs($user);

        $response = $this->post(route('admin.categories.store'), ['name' => 'test']);

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('categories', ['name' => 'test']);
    }

    public function test_admin_can_edit_category(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        $this->actingAs($user);

        $response = $this->put(route('admin.categories.update', $category), ['name' => 'new name']);

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('categories', ['name' => 'new name']);
    }

    public function test_admin_can_delete_category(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        $this->actingAs($user);

        $response = $this->delete(route('admin.categories.delete', $category));

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas('error');

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_admin_can_view_category_list(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $categories = Category::factory(3)->create();

        $this->actingAs($user);

        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(200);

        foreach ($categories as $category) {
            $response->assertSee($category->title);
        }
    }
}
