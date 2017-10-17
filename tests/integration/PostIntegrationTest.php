<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;
class PostIntegrationTest extends TestCase
{
    use DatabaseTransactions;
   function test_a_slug_is_genereted_and_saved_to_the_database()
   {
        //$user = $this->defaultUser();
        $post = $this->createPost([
           'title' => 'Como instalar laravel'
        ]);
        
       /*$this->seeInDatabase('posts', [
            'slug'  => 'como-instalar-laravel'
       ]);
       $this->assertSame('como-instalar-laravel', $post->slug);
       */
       $this->assertSame(
        'como-instalar-laravel',
        $post->fresh()->slug
       );
   }
}
