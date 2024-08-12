<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'user_id' => 1,
            'category_id' => rand(1, 5),
            'title' => 'Title',
            'short_content' => 'Short Content',
            'content' => 'Content',
        ]);
        Post::create([
            'user_id' => 1,
            'category_id' => rand(1, 5),
            'title' => 'Sarlavha',
            'short_content' => 'Qisqacha',
            'content' => 'Toliq manba',
        ]);
    }
}
