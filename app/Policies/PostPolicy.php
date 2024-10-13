<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy {
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete( User $user, Post $post ): Response {
        $user->id === $post->id
        ? Response::allow()
        : Response::deny( 'You are not allowed to delete' );
    }
}