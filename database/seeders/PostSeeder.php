<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->get();
        $categories = Category::query()->get(['id']);

        $users->each(function ($user) use ($categories) {
            Post::factory(5)->create([
                'user_id' => $user->id,
                'category_id' => $categories->random()->id,
            ]);
        });
    }
}
