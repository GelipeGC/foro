<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::select('id')->get();

        $posts = Post::select('id')->get();

        for ($i=0; $i < 250; $i++) { 
            $comment = factory(\App\Comment::class)->create([
                'user_id' => $users->random()->id,
                'post_id'   => $posts->random()->id,
            ]);

            if (rand(0, 1)) {
                $comment->markAsAnswer();
            }
        }
    }
}
