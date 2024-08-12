<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
//            UserSeeder::class,
            CategorySeeder::class,
//            PostSeeder::class,
//            PostSeeder::class,
            TagSeeder::class,
        ]);

    }
}
