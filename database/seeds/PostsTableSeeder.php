<?php
use App\User;
use App\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 5; $i++) {
          $newPost = new Post;
          $newPost->titolo = $faker->sentence(4);
          $newPost->corpo = $faker->text(455);
          $newPost->slug = Str::finish(Str::slug($newPost->titolo), rand(1, 999));
          $newPost->user_id = User::inRandomOrder()->first()->id;
          $newPost->pubblicato = rand(0, 1);
          $newPost->save();
    }
}
}
