<?php

use App\Post;

class CreatePosts extends FeatureTestCase
{
    function test_a_user_crate_a_post()
    {
        //having-->tengo
        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';

        $this->actingAs($user = $this->defaultUser());
        //where-->donde
        $this->visit(route('posts.create'))
            ->type($title,'title')
            ->type($content,'content')
            ->press('Publicar');

        //then-->entonces 
        $this->seeInDatabase('posts', [
            'title' => $title,
            'content' => $content,
            'pending' => true,
            'user_id' => $user->id,
            'slug'  => 'esta-es-una-pregunta',
        ]);

        $post = Post::first();
        
        // test the author is suscribed automatically to the post.
        $this->seeInDatabase('subscriptions', [
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        //Test a user is redirected to the posts details after creating it.
        $this->seePageIs($post->url);
    }
    function test_creating_a_post_requires_authentication()
    {
        //when
        $this->visit(route('posts.create'))
            ->seePageIs(route('token'));
    }

    function test_create_post_form_validation()
    {
        $this->actingAs($this->defaultUser())
            ->visit(route('posts.create'))
            ->press('Publicar')
            ->seePageIs(route('posts.create'))
            ->seeErrors([
                'title' => 'El campo título es obligatorio',
                'content' => 'El campo contenido es obligatorio'
            ]);
            
    }
}
