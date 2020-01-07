<?php

namespace App\Policies\Blog;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

     /**
     * Create a new policy instance.
     *
     * @return void
     */
     public function view(User $user)
    {
        return $user->isAdmin();
    }


    /**
     * Determine if the given post can be created by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function create(User $user)
    { 
        return $user->isAdmin();
    }


    /**
     * Determine if the given post can be created by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function edit(User $user)
    { 
       return $user->isAdmin();
    }

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function update(User $user)
    { 
        return $user->isAdmin();
    }


    public function before($user, $ability)
    {
        return $user->isAdmin();
    }
}
