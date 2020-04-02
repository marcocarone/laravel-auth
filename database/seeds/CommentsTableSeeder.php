<?php

use Illuminate\Database\Seeder;

use App\Comment;
use App\Post;
use Faker\Generator as Faker;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 20; $i++) {
          $newComment = new Comment;
          $newComment->commento = $faker->text(155);
          $newComment->post_id = Post::inRandomOrder()->first()->id;
          $newComment->save();
      }
    }
}
