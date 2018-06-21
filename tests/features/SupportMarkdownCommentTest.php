<?php



class SupportMarkdownCommentTest extends TestCase
{
    
    public function test_the_post_comments_support_markdown()
    {
        $post = $this->createPost();

        $user = $this->defaultUser();


        $this->actingAs($user)
            ->visit($post->url)
            ->type('Un comentario', 'comment')
            ->press('Publicar comentario');
        $commentImport = 'Este es un comentario importante';

        //$post->
    }
}
