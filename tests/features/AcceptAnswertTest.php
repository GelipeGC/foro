<?php


use App\{User, Comment};

class AcceptAnswertTest extends TestCase
{
    
    public function test_the_posts_autor_can_accept_a_comment_as_the_posts_answer()
    {
        $comment = factory(Comment::class)->create([
            'comment' => 'Esta va ser la respuesta del post'
        ]);
        
        $this->actingAs($comment->post->user);

        $this->visit($comment->post->url)
            ->press('Aceptar respuesta');
        
        $this->seeInDatabase('posts', [
            'id' => $comment->post_id,
            'pending' => false,
            'answer_id' => $comment->id,
        ]);
        
        $this->seePageIs($comment->post->url)
                ->seeInElement('.answer', $comment->comments);
        
        
    }
    public function test_non_posts_autor_dont_see_the_accept_answer_button()
    {
        $comment = factory(Comment::class)->create([
            'comment' => 'Esta va ser la respuesta del post'
        ]);
        
        $this->actingAs(factory(User::class)->create());

        $this->visit($comment->post->url)
            ->dontSee('Aceptar respuesta');
        
    }
    public function test_non_posts_autor_cannot_accept_a_comment_as_the_posts_answer()
    {
        $comment = factory(Comment::class)->create([
            'comment' => 'Esta va ser la respuesta del post'
        ]);
        
        $this->actingAs(factory(User::class)->create());

        
        $this->post(route('comments.accept', $comment));

        $this->seeInDatabase('posts', [
            'id' => $comment->post_id,
            'pending' => true,
        ]);
        
        
    }

    public function test_the_accept_button_is_hidden_when_the_comment_is_already_the_posts_answer()
    {
        $comment = factory(Comment::class)->create([
            'comment' => 'Esta va ser la respuesta del post'
        ]);
        
        $this->actingAs($comment->post->user);

        $comment->markAsAnswer();

        $this->visit($comment->post->url)
            ->dontSee('Aceptar respuesta');
        
    }
}
