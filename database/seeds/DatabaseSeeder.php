<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Comment;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(ArticleSeeder::class);
        Factory(Category::class, 5)->create();
        Factory(Comment::class, 40)->create();

        factory(User::class)->create([
            'name' => "Alice",
            'email' => 'alice@gmail.com',
        ]);

        factory(User::class)->create([
            'name' => 'Bob',
            'email' => 'bob@gmail.com',
        ]);
    }
}
