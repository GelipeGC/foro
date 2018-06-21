<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function accept(User $user, Comment $comment)
    {
        //pendiente de la otra solucion nose porque no me queda :(
        //return $user->owns($comment->post);
        return $user->id === $comment->post->user_id;
        
    }
}
