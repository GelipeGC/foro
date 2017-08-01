<?php

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
        ]);

        //Test a user is redirected to the posts details after creating it.
        $this->see($title);
    }
    function test_creating_a_post_requires_authentication()
    {
        //when
        $this->visit(route('posts.create'))
            ->seePageIs(route('login'));
    }
}
