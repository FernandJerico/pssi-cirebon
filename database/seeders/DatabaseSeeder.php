<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use App\Models\Player;
use App\Models\Category;
use App\Models\Coach;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'Admin',
        //     'username' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('zxczxc')
        // ]);

        // User::create([
        //     'name' => 'Nikolas Wijaya',
        //     'email' => 'nikolas@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        // Category::create([
        //     'name' => 'Football',
        //     'slug' => 'football'
        // ]);

        // Category::create([
        //     'name' => 'Futsal',
        //     'slug' => 'futsal'
        // ]);

        // Post::factory(20)->create();
        // Team::factory(18)->create();
        Player::factory(50)->create();
        // Coach::factory(18)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit accusamus',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit accusamus ipsum veritatis vitae unde, odio amet dolores quae perspiciatis provident neque eligendi, corporis architecto itaque error ducimus! Quas, ex esse.',
        //     'category_id' => 1,
        //     'user_id' => 1,
        // ]);

        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit accusamus',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit accusamus ipsum veritatis vitae unde, odio amet dolores quae perspiciatis provident neque eligendi, corporis architecto itaque error ducimus! Quas, ex esse.',
        //     'category_id' => 1,
        //     'user_id' => 2,
        // ]);

        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit accusamus',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit accusamus ipsum veritatis vitae unde, odio amet dolores quae perspiciatis provident neque eligendi, corporis architecto itaque error ducimus! Quas, ex esse.',
        //     'category_id' => 2,
        //     'user_id' => 1,
        // ]);
    }
}