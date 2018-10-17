<?php

namespace Tests;

use App\{Post, User};

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
    
}