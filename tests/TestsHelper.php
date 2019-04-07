<?php

namespace Tests;

use App\{Post, User};
use Illuminate\Auth\AuthenticationException;

trait TestsHelper
{
    /**
     *  @var \App\User;
     */
    protected $defaultUser;

    public function defaultUser(array $attributes = [])
    {
        if ($this->defaultUser) {
            return $this->defaultUser;
        }

        return $this->defaultUser = factory(User::class)->create($attributes);
    }

    public function createPost(array $attributes = [])
    {
        return $post = factory(Post::class)->create($attributes); 
    }

    protected function anyone(array $attributes = [])
    {
        return factory(User::class)->create($attributes);
    }

    protected function handleAuthenticationExceptions()
    {
        $this->withoutExceptionHandling([
            AuthenticationException::class
        ]);
    }
    
}
