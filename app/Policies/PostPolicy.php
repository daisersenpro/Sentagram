<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        // Solo permite eliminar si el usuario es el propietario del post
        return $user->id === $post->user_id;
    }
}
