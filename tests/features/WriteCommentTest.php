<?php

use Illuminate\Support\Facades\Notification;

class WriteCommentTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_write_a_comment()
    {
        Notification::fake();
        $post = $this->createPost();

        $user = $this->defaultUser();


        $this->actingAs($user)
            ->visit($post->url)
            ->type('Un comentario', 'comment')
            ->press('Publicar comentario');

            $this->seeInDatabase('comments', [
                'comment' => 'Un comentario',
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);

            $this->seePageIs($post->url);
    }

    public function test_create_comment_form_validation()
    {
        $post = $this->createPost();

        $user = $this->defaultUser();
        $this->actingAs($user)
            ->visit($post->url)
            ->press('Publicar comentario')
            ->seeErrors([
                'comment' => 'El campo comentario es obligatorio',
            ]);

    }
}
