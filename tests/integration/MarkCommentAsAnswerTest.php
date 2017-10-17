<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Comment;
class MarkCommentAsAnswerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_post_can_be_answered()
    {
        $post = $this->createPost();

        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
        ]);
        $comment->markAsAnswer();
        $this->assertTrue($comment->fresh()->answer);
        $this->assertFalse($post->fresh()->pending);
    }
    public function test_a_post_can_only_have_one_answer()
    {
        $post = $this->createPost();

        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
        ]);
        $comment->markAsAnswer();
        $this->assertTrue($comment->fresh()->answer);
        $this->assertFalse($post->fresh()->pending);
    }
}
