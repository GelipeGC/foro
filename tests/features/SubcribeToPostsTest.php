<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
class SubcribeToPostsTest extends FeatureTestCase
{
   
    function test_a_user_can_subscribe_to_a_post()
    {
        //having
        $post = $this->createPost();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        //when
        $this->visit($post->url)
            ->press('Subscribirse al post');

        //then
        $this->seeInDatabase('subscriptions', [
            'user_id' => $user->id,
            'post_id'   => $post->id,
        ]);

        $this->seePageIs($post->url)
            ->dontSee('Subscribirse al post');
    }
}
